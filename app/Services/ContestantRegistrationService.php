<?php

namespace App\Services;

use App\Models\Contestant;
use App\Models\ContestantSocial;
use App\Models\ContestantStageReview;
use App\Models\ContestantVideo;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ContestantRegistrationService
{
    private const CACHE_PREFIX = 'contestant_registration:';
    private const OTP_TTL_MINUTES = 5;

    public function startRegistration(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
            'social_platforms' => 'nullable|array',
            'social_platforms.instagram' => 'required|url',
            'social_platforms.*' => 'nullable|url',
            'intro_video' => 'required|file|mimes:mp4,mov,mkv|max:153600',
            'sales_video' => 'nullable|file|mimes:mp4,mov,mkv|max:153600',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'experience' => 'nullable|string',
            'employer' => 'nullable|string',
            'participation_reason' => 'nullable|string',
            'standout_reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $payload = $validator->validated();
        $storageToken = (string) Str::uuid();

        $profilePhotoPath = $request->file('profile_photo')->store(
            "pending/contestants/{$storageToken}/photos",
            'public'
        );

        $introVideoPath = $request->file('intro_video')->store(
            "pending/contestants/{$storageToken}/videos",
            'public'
        );

        $salesVideoPath = null;
        if ($request->hasFile('sales_video')) {
            $salesVideoPath = $request->file('sales_video')->store(
                "pending/contestants/{$storageToken}/videos",
                'public'
            );
        }

        $otpCode = (string) random_int(1000, 9999);

        $pendingPayload = [
            'full_name' => $payload['full_name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'password' => Hash::make($payload['password']),
            'profile_photo_path' => $profilePhotoPath,
            'intro_video_path' => $introVideoPath,
            'sales_video_path' => $salesVideoPath,
            'social_platforms' => $payload['social_platforms'] ?? [],
            'dob' => $payload['dob'] ?? null,
            'gender' => $payload['gender'] ?? null,
            'nationality_id' => $payload['nationality_id'] ?? null,
            'experience' => $payload['experience'] ?? null,
            'employer' => $payload['employer'] ?? null,
            'participation_reason' => $payload['participation_reason'] ?? null,
            'standout_reason' => $payload['standout_reason'] ?? null,
            'otp_sent_at' => now()->toIso8601String(),
            'storage_token' => $storageToken,
        ];

        Cache::forever($this->cacheKey($payload['phone']), $pendingPayload);

        Otp::updateOrCreate(
            ['phone' => $payload['phone']],
            [
                'code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(self::OTP_TTL_MINUTES),
            ]
        );

        $this->sendOtp($payload['phone'], 'كود التحقق الخاص بك هو : ' . $otpCode);

        return [
            'phone' => $payload['phone'],
            'expires_in_seconds' => self::OTP_TTL_MINUTES * 60,
        ];
    }

    public function verifyOtpAndCreate(array $data): array
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
                'phone' => ['No pending registration found for this phone. Please register first.'],
            ]);
        }

        if (($pending['phone'] ?? null) !== $phone) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone number for this registration session.'],
            ]);
        }

        $otp = Otp::where('phone', $pending['phone'])->first();

        if (!$otp) {
            throw ValidationException::withMessages([
                'otp' => ['OTP was not found. Please request a new code.'],
            ]);
        }

        if (Carbon::parse($otp->expires_at)->isPast()) {
            $otp->delete();
            throw ValidationException::withMessages([
                'otp' => ['OTP has expired. Please request a new code.'],
            ]);
        }

        if ($otp->code !== $data['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP code.'],
            ]);
        }

        DB::beginTransaction();

        try {
            if (User::where('email', $pending['email'])->exists() || User::where('phone', $pending['phone'])->exists()) {
                throw ValidationException::withMessages([
                    'phone' => ['A user with this phone or email already exists.'],
                ]);
            }

            $user = User::create([
                'name' => $pending['full_name'],
                'phone' => $pending['phone'],
                'email' => $pending['email'],
                'password' => $pending['password'],
                'type' => 'contestant',
            ]);

            $disk = Storage::disk('public');

            $finalPhotoPath = $this->movePendingFile(
                $disk,
                $pending['profile_photo_path'],
                $this->buildPhotoFileName($user->id, $pending['full_name'])
            );
            $finalIntroPath = $this->movePendingFile(
                $disk,
                $pending['intro_video_path'],
                $this->buildVideoFileName($user->id, $pending['full_name'], 'intro')
            );
            $finalSalesPath = $this->movePendingFile(
                $disk,
                $pending['sales_video_path'],
                $this->buildVideoFileName($user->id, $pending['full_name'], 'sales')
            );

            $contestant = Contestant::create([
                'user_id' => $user->id,
                'profile_photo_path' => $finalPhotoPath,
                'dob' => $pending['dob'],
                'gender' => $pending['gender'],
                'nationality_id' => $pending['nationality_id'],
                'phone' => $pending['phone'],
                'experience' => $pending['experience'],
                'employer' => $pending['employer'],
                'participation_reason' => $pending['participation_reason'],
                'standout_reason' => $pending['standout_reason'],
                'code' => (string) random_int(100000, 999999),
                'expire_at' => now()->addDays(7),
            ]);

            ContestantStageReview::create([
                'contestant_id' => $contestant->id,
                'stage_number' => 0,
                'status' => 'pending',
                'is_winner' => 0,
            ]);

            ContestantVideo::create([
                'contestant_id' => $contestant->id,
                'type' => 'intro',
                'file_path' => $finalIntroPath,
                'stage_number' => 0,
                'video_number' => 1,
            ]);

            if ($finalSalesPath) {
                ContestantVideo::create([
                    'contestant_id' => $contestant->id,
                    'type' => 'sales',
                    'file_path' => $finalSalesPath,
                    'stage_number' => 0,
                    'video_number' => 2,
                ]);
            }

            foreach ($pending['social_platforms'] ?? [] as $platform => $link) {
                if (!$link) {
                    continue;
                }

                ContestantSocial::create([
                    'contestant_id' => $contestant->id,
                    'platform' => $platform,
                    'link' => $link,
                ]);
            }

            $otp->delete();
            Cache::forget($this->cacheKey($pending['phone']));
            $this->deletePendingDirectory($pending['storage_token'] ?? null);

            DB::commit();

            $token = $user->createToken('contestant-api-token')->plainTextToken;

            return [
                'user' => $user,
                'contestant' => $contestant,
                'token' => $token,
            ];
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Contestant API registration verification failed', [
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
                'phone' => ['No pending registration found for this phone. Please register first.'],
            ]);
        }

        if (($pending['phone'] ?? null) !== $phone) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone number for this registration session.'],
            ]);
        }

        $otpCode = (string) random_int(1000, 9999);
        Otp::updateOrCreate(
            ['phone' => $pending['phone']],
            [
                'code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(self::OTP_TTL_MINUTES),
            ]
        );

        $pending['otp_sent_at'] = now()->toIso8601String();
        Cache::forever($this->cacheKey($phone), $pending);

        $this->sendOtp($pending['phone'], 'كود التحقق الجديد هو : ' . $otpCode);

        return [
            'phone' => $pending['phone'],
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

        $user = User::where('phone', $data['phone'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone number or password.'],
            ]);
        }

        $token = $user->createToken('contestant-login-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function forgotPassword(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('phone', $data['phone'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => ['User not found.'],
            ]);
        }

        $otpCode = (string) random_int(1000, 9999);
        $expiresAt = Carbon::now()->addMinutes(self::OTP_TTL_MINUTES);

        $user->forceFill([
            'otp' => $otpCode,
            'otp_expired_at' => $expiresAt,
        ])->save();

        $this->sendOtp($user->phone, 'كود استعادة كلمة المرور الخاص بك هو : ' . $otpCode);

        return [
            'phone' => $user->phone,
            'expires_in_seconds' => self::OTP_TTL_MINUTES * 60,
        ];
    }

    public function verifyForgotPasswordOtp(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('phone', $data['phone'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => ['User not found.'],
            ]);
        }

        if (!$user->otp) {
            throw ValidationException::withMessages([
                'otp' => ['OTP was not found. Please request a new code.'],
            ]);
        }

        if (!$user->otp_expired_at || $user->otp_expired_at->isPast()) {
            $user->forceFill([
                'otp' => null,
                'otp_expired_at' => null,
            ])->save();

            throw ValidationException::withMessages([
                'otp' => ['OTP has expired. Please request a new code.'],
            ]);
        }

        if ($user->otp !== $data['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP code.'],
            ]);
        }

        $user->forceFill([
            'otp' => null,
            'otp_expired_at' => null,
        ])->save();

        return [
            'phone' => $user->phone,
        ];
    }

    public function resetPassword(array $data): array
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|max:20',
            'new_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('phone', $data['phone'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => ['User not found.'],
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($data['new_password']),
            'otp' => null,
            'otp_expired_at' => null,
        ])->save();

        return [
            'phone' => $user->phone,
        ];
    }

    public function getProfile(User $user): array
    {
        $user->loadMissing(['contestant.videos', 'contestant.socials', 'contestant.nationality']);

        return $this->profilePayload($user);
    }

    public function getProfileById(int $id): array
    {
        $user = User::with(['contestant.videos', 'contestant.socials', 'contestant.nationality'])->find($id);

        if (!$user) {
            throw ValidationException::withMessages([
                'id' => ['User not found.'],
            ]);
        }

        return $this->profilePayload($user);
    }

    public function updateProfile(int $id, Request $request, ?User $authenticatedUser): array
    {
        if (!$authenticatedUser) {
            throw ValidationException::withMessages([
                'auth' => ['Unauthenticated.'],
            ]);
        }

        if ($authenticatedUser->id !== $id) {
            throw ValidationException::withMessages([
                'id' => ['You are not allowed to update this profile.'],
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'phone' => 'sometimes|string|max:20|unique:users,phone,' . $id,
            'dob' => 'sometimes|nullable|date',
            'gender' => 'sometimes|nullable|in:male,female',
            'nationality_id' => 'sometimes|nullable|exists:nationalities,id',
            'experience' => 'sometimes|nullable|string',
            'employer' => 'sometimes|nullable|string',
            'participation_reason' => 'sometimes|nullable|string',
            'standout_reason' => 'sometimes|nullable|string',
            'social_platforms' => 'sometimes|array',
            'social_platforms.instagram' => 'sometimes|nullable|url',
            'social_platforms.*' => 'sometimes|nullable|url',
            'profile_photo' => 'sometimes|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'intro_video' => 'sometimes|file|mimes:mp4,mov,mkv|max:153600',
            'sales_video' => 'sometimes|file|mimes:mp4,mov,mkv|max:153600',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        if (isset($validated['full_name']) && !isset($validated['name'])) {
            $validated['name'] = $validated['full_name'];
        }

        $userData = array_intersect_key($validated, array_flip(['name', 'email', 'phone']));
        $contestantData = array_intersect_key($validated, array_flip([
            'dob',
            'gender',
            'nationality_id',
            'experience',
            'employer',
            'participation_reason',
            'standout_reason',
        ]));

        if (!empty($userData)) {
            $authenticatedUser->fill($userData)->save();
        }

        $contestant = $authenticatedUser->contestant;
        if ($contestant) {
            if (!empty($contestantData)) {
                $contestant->fill($contestantData);
            }

            if (isset($userData['phone'])) {
                $contestant->phone = $userData['phone'];
            }

            $disk = Storage::disk('public');
            $fullName = $authenticatedUser->name ?: 'user';

            if ($request->hasFile('profile_photo')) {
                if ($contestant->profile_photo_path && $disk->exists($contestant->profile_photo_path)) {
                    $disk->delete($contestant->profile_photo_path);
                }

                $contestant->profile_photo_path = $request->file('profile_photo')->storeAs(
                    'photos',
                    basename($this->buildPhotoFileName($authenticatedUser->id, $fullName)) . '.' . $request->file('profile_photo')->getClientOriginalExtension(),
                    'public'
                );
            }

            $contestant->save();

            if ($request->hasFile('intro_video')) {
                $this->storeOrUpdateContestantVideo(
                    $contestant,
                    $request,
                    'intro_video',
                    'intro',
                    1,
                    $fullName
                );
            }

            if ($request->hasFile('sales_video')) {
                $this->storeOrUpdateContestantVideo(
                    $contestant,
                    $request,
                    'sales_video',
                    'sales',
                    2,
                    $fullName
                );
            }

            if (array_key_exists('social_platforms', $validated) && is_array($validated['social_platforms'])) {
                foreach ($validated['social_platforms'] as $platform => $link) {
                    if ($link) {
                        $contestant->socials()->updateOrCreate(
                            ['platform' => $platform],
                            ['link' => $link]
                        );
                    } else {
                        $contestant->socials()->where('platform', $platform)->delete();
                    }
                }
            }


        }

        $authenticatedUser->load(['contestant.videos', 'contestant.socials', 'contestant.nationality']);

        return $this->profilePayload($authenticatedUser);
    }

    public function logout(?User $user): array
    {
        if (!$user) {
            return [];
        }

        $token = $user->currentAccessToken();

        if ($token) {
            $token->delete();
        } else {
            $user->tokens()->delete();
        }

        return [];
    }

    private function cacheKey(string $phone): string
    {
        return self::CACHE_PREFIX . $phone;
    }

    private function profilePayload(User $user): array
    {
        $contestant = $user->contestant;
        $instagram = null;
        $introVideo = null;

        if ($contestant) {
            $instagram = optional($contestant->socials->firstWhere('platform', 'instagram'))->link;
            $introVideo = optional($contestant->videos->firstWhere('type', 'intro'))->file_path;
        }

        return [
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'social_platforms' => [
                'instagram' => $instagram,
            ],
            'profile_photo' => $contestant && $contestant->profile_photo_path
                ? asset('storage/' . $contestant->profile_photo_path)
                : null,
            'intro_video' => $introVideo
                ? asset('storage/' . $introVideo)
                : null,
        ];
    }

    private function storeOrUpdateContestantVideo(
        Contestant $contestant,
        Request $request,
        string $requestKey,
        string $type,
        int $videoNumber,
        string $fullName
    ): void {
        $disk = Storage::disk('public');
        $existingVideo = $contestant->videos()->where('type', $type)->first();

        if ($existingVideo && $existingVideo->file_path && $disk->exists($existingVideo->file_path)) {
            $disk->delete($existingVideo->file_path);
        }

        $file = $request->file($requestKey);
        $path = $file->storeAs(
            'videos',
            basename($this->buildVideoFileName($contestant->user_id, $fullName, $type)) . '.' . $file->getClientOriginalExtension(),
            'public'
        );

        $contestant->videos()->updateOrCreate(
            ['type' => $type],
            [
                'file_path' => $path,
                'stage_number' => 0,
                'video_number' => $videoNumber,
            ]
        );
    }

    private function sendOtp(string $phone, string $message): void
    {
        try {
            $whatsapp = app(WhatsAppService::class);
            $whatsapp->send($phone, $message);
        } catch (\Throwable $exception) {
            Log::error('Failed to send contestant registration OTP', [
                'phone' => $phone,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    private function movePendingFile($disk, ?string $oldPath, string $targetBaseName): ?string
    {
        if (!$oldPath || !$disk->exists($oldPath)) {
            return null;
        }

        $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
        $newPath = $targetBaseName . ($extension ? '.' . $extension : '');

        $disk->move($oldPath, $newPath);

        return $newPath;
    }

    private function buildPhotoFileName(int $userId, string $fullName): string
    {
        return 'photos/' . $userId . '_' . $this->sanitizeFileName($fullName) . '_photo';
    }

    private function buildVideoFileName(int $userId, string $fullName, string $suffix): string
    {
        return 'videos/' . $userId . '_' . $this->sanitizeFileName($fullName) . '_' . $suffix;
    }

    private function sanitizeFileName(string $value): string
    {
        $value = trim(preg_replace('/[\\\\\\/:"*?<>|]+/', '', $value) ?? $value);
        $value = preg_replace('/\s+/', ' ', $value) ?? $value;

        return $value !== '' ? $value : 'user';
    }

    private function deletePendingDirectory(?string $storageToken): void
    {
        if (!$storageToken) {
            return;
        }

        Storage::disk('public')->deleteDirectory("pending/contestants/{$storageToken}");
    }
}
