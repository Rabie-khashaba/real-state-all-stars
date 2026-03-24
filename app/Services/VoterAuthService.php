<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VoterAuthService
{
    private const CACHE_PREFIX = 'voter_registration:';
    private const OTP_TTL_MINUTES = 5;
    private const RESEND_COOLDOWN_SECONDS = 60;

    public function register(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'phone.unique' => 'رقم الهاتف مسجل بالفعل. من فضلك استخدم رقمًا آخر أو سجّل الدخول.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();
        $otpCode = (string) random_int(1000, 9999);

        Cache::forever($this->cacheKey($validated['phone']), [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'type' => 'voter',
            'otp_sent_at' => now()->toIso8601String(),
        ]);

        Otp::updateOrCreate(
            ['phone' => $validated['phone']],
            [
                'code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(self::OTP_TTL_MINUTES),
            ]
        );

        $this->sendOtp($validated['phone'], 'كود التحقق الخاص بك هو : ' . $otpCode);

        Log::info('Voter OTP generated', [
            'phone' => $validated['phone'],
            'code' => $otpCode,
        ]);

        return [
            'phone' => $validated['phone'],
            'expires_in_seconds' => self::OTP_TTL_MINUTES * 60,
        ];
    }

    public function verifyVoterOtp(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $phone = $data['phone'];
        $pending = Cache::get($this->cacheKey($phone));

        if (!$pending) {
            throw ValidationException::withMessages([
                'phone' => ['لا يوجد تسجيل معلّق لهذا الرقم. من فضلك ابدأ التسجيل مرة أخرى.'],
            ]);
        }

        $otp = Otp::where('phone', $phone)->first();

        if (!$otp) {
            throw ValidationException::withMessages([
                'otp' => ['لا يوجد كود. اطلب كود جديد.'],
            ]);
        }

        if (Carbon::parse($otp->expires_at)->isPast()) {
            $otp->delete();

            throw ValidationException::withMessages([
                'otp' => ['الكود منتهي. اطلب كود جديد.'],
            ]);
        }

        if ($otp->code !== $data['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['كود خاطئ.'],
            ]);
        }

        DB::beginTransaction();

        try {
            if (
                User::where('phone', $pending['phone'])->exists() ||
                User::where('email', $pending['email'])->exists()
            ) {
                throw ValidationException::withMessages([
                    'phone' => ['يوجد حساب بالفعل بهذا الرقم أو البريد الإلكتروني.'],
                ]);
            }

            $user = User::create([
                'name' => $pending['name'],
                'phone' => $pending['phone'],
                'email' => $pending['email'],
                'password' => $pending['password'],
                'type' => 'voter',
            ]);

            $token = $user->createToken('voter-api-token')->plainTextToken;

            $otp->delete();
            Cache::forget($this->cacheKey($phone));

            DB::commit();

            return [
                'token' => $token,
                'user' => $user,
            ];
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Voter registration verification failed', [
                'phone' => $phone,
                'message' => $exception->getMessage(),
            ]);
            throw $exception;
        }
    }

    public function resendOtp(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $phone = $data['phone'];
        $pending = Cache::get($this->cacheKey($phone));

        if (!$pending) {
            throw ValidationException::withMessages([
                'phone' => ['الجلسة منتهية أو لا يوجد تسجيل معلّق لهذا الرقم.'],
            ]);
        }

        $lastSentAt = isset($pending['otp_sent_at']) ? Carbon::parse($pending['otp_sent_at']) : null;
        if ($lastSentAt && $lastSentAt->diffInSeconds(now()) < self::RESEND_COOLDOWN_SECONDS) {
            $remaining = self::RESEND_COOLDOWN_SECONDS - $lastSentAt->diffInSeconds(now());

            throw ValidationException::withMessages([
                'otp' => ["استنى {$remaining} ثانية قبل إعادة الإرسال."],
            ]);
        }

        $otpCode = (string) random_int(1000, 9999);

        Otp::updateOrCreate(
            ['phone' => $phone],
            [
                'code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(self::OTP_TTL_MINUTES),
            ]
        );

        $pending['otp_sent_at'] = now()->toIso8601String();
        Cache::forever($this->cacheKey($phone), $pending);

        $this->sendOtp($phone, 'كود التحقق الخاص بك هو : ' . $otpCode);

        Log::info('Voter OTP resent', [
            'phone' => $phone,
            'code' => $otpCode,
        ]);

        return [
            'phone' => $phone,
            'expires_in_seconds' => self::OTP_TTL_MINUTES * 60,
        ];
    }

    public function login(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('phone', $data['phone'])
            ->where('type', 'voter')
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['رقم الهاتف أو كلمة المرور غير صحيحة.'],
            ]);
        }

        return [
            'user' => $user,
            'token' => $user->createToken('voter-login-token')->plainTextToken,
        ];
    }

    private function cacheKey(string $phone): string
    {
        return self::CACHE_PREFIX . $phone;
    }

    private function sendOtp(string $phone, string $message): void
    {
        try {
            $whatsapp = app(WhatsAppService::class);
            $whatsapp->send($phone, $message);
        } catch (\Throwable $exception) {
            Log::error('Failed to send voter OTP', [
                'phone' => $phone,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
