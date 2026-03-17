<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class VoterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'phone.unique' => 'رقم الهاتف مسجل بالفعل. من فضلك استخدم رقمًا آخر أو سجّل الدخول.',
        ]);

        // خزن البيانات مؤقتا لحد التحقق من OTP
        session([
            'otp_pending' => [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'type' => 'voter',
            ],
            'otp_phone'   => $validated['phone'],
            'otp_sent_at' => now(),
        ]);

        // Generate + Save OTP (4 digits)
        $code = (string) random_int(1000, 9999);

        Otp::updateOrCreate(
            ['phone' => $validated['phone']],
            [
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]
        );


        // // Send WhatsApp message
        $whatsappService = app(\App\Services\WhatsAppService::class);
        $whatsappService->send($validated['phone'], 'كود التحقق الخاص بك هو : ' . $code);

        // (اختياري) للتجربة فقط
        session(['debug_code' => $code]);
        Log::info('OTP generated', ['phone' => $validated['phone'], 'code' => $code]);

        // TODO: ابعته SMS/WhatsApp هنا لو عندك خدمة إرسال
        // app(WhatsAppService::class)->sendUsingAccessToken(...)

        return redirect()->route('voter.otp.form')
            ->with('success', 'تم إرسال كود التحقق ✅');
    }

    public function showOtpForm()
    {
        $phone = session('otp_phone');
        $pending = session('otp_pending');

        if (!$phone || !$pending) {
            return redirect('/signIn')->withErrors(['otp' => 'الجلسة منتهية. سجل مرة أخرى']);
        }

        return view('website.vote.otp', [
            'phone' => $phone,
            'debug_code' => session('debug_code') // للتجربة
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4'
        ], [
            'otp.required' => 'الكود مطلوب',
            'otp.digits' => 'الكود لازم يكون 4 أرقام',
        ]);

        $phone = session('otp_phone');
        $pending = session('otp_pending');

        if (!$phone || !$pending) {
            return redirect('/signIn')->withErrors(['otp' => 'الجلسة منتهية']);
        }

        $otp = Otp::where('phone', $phone)->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'لا يوجد كود. اطلب كود جديد']);
        }

        if ($otp->expires_at < now()) {
            $otp->delete();
            return back()->withErrors(['otp' => 'الكود منتهي. اطلب كود جديد']);
        }

        if ($otp->code !== $request->otp) {
            return back()->withErrors(['otp' => 'كود خاطئ'])->withInput();
        }

        // نجاح: إنشاء المستخدم + login + حذف OTP + تنظيف session
        $user = User::create($pending);
        Auth::login($user);

        $otp->delete();
        session()->forget(['otp_phone', 'otp_pending', 'otp_sent_at', 'debug_code']);

        return redirect('/voter/profile/' . $user->id)
            ->with('success', 'تم تأكيد الرقم وتسجيل الدخول ✅');
    }

    public function resendOtp()
    {
        $phone = session('otp_phone');
        $pending = session('otp_pending');

        if (!$phone || !$pending) {
            return redirect('/signIn')->withErrors(['otp' => 'الجلسة منتهية']);
        }

        // rate limit بسيط: كل 60 ثانية
        $lastSent = session('otp_sent_at');
        if ($lastSent && now()->diffInSeconds($lastSent) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastSent);
            return back()->withErrors(['otp' => "استنى {$remaining} ثانية قبل إعادة الإرسال"]);
        }

        $code = (string) random_int(1000, 9999);

        Otp::updateOrCreate(
            ['phone' => $phone],
            [
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]
        );

        // Send WhatsApp message
                $whatsappService = app(\App\Services\WhatsAppService::class);
                $whatsappService->send($phone, 'كود التحقق الخاص بك هو : ' . $code);

        session(['otp_sent_at' => now(), 'debug_code' => $code]);
        Log::info('OTP resent', ['phone' => $phone, 'code' => $code]);

        // TODO: ابعته SMS/WhatsApp هنا

        return back()->with('success', 'تم إرسال كود جديد ✅');
    }

    // profile / package زي ما هما
    public function profile($id)
    {
        $user = Auth::user();
        if (!$user || $user->id != $id) abort(403, 'Unauthorized access');
        return view('website.vote.voterProfile', compact('user'));
    }

    public function package($id)
    {
        $user = Auth::user();
        if (!$user || $user->id != $id) abort(403, 'Unauthorized access');
        return view('website.vote.package', compact('user'));
    }
}
