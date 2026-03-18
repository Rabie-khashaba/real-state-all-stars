<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contestant;
use App\Models\ContestantSetting;
use App\Models\Vote;
use App\Models\UserDailyVote;
use App\Models\ContestantVideo;
use App\Models\ContestantSocial;
use App\Models\ContestantStageReview;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class ContestantController extends Controller
{
    /* =========================================================
     | INDEX
     ========================================================= */
    public function index(Request $request)
    {
        $contestantSetting = ContestantSetting::first();
        $imageDomain = config('app.image_domain');
        $appUrl = config('app.url');

        $imageUrl = $contestantSetting && $contestantSetting->image_path
            ? $imageDomain . '/storage/' . $contestantSetting->image_path
            : $appUrl . '/images/prize-bg.png';

        $search = $request->query('search');

        $contestants = Contestant::with('user', 'videos')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->whereHas('contestantStageReview', function ($q) {
                $q->where('status', 'approved');
            })
            ->paginate(9)
            ->appends(['search' => $search]);

        $canVote = false;
        if ($request->user()) {
            $dailyVote = UserDailyVote::getTodayRecord($request->user());
            $canVote = $dailyVote->canVote();
        }

        return view('website.vote.index', compact('contestants', 'canVote', 'imageUrl'));
    }

    /* =========================================================
     | REGISTER - SESSION ONLY (DB AFTER OTP)
     ========================================================= */
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cropped_profile_photo' => 'nullable|string',
            'full_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'experience' => 'nullable|string',
            'employer' => 'nullable|string',
            'expertise' => 'nullable|array',
            'expertise.*' => 'string',
            'expertise_other' => 'nullable|string',
            'destination' => 'nullable|array',
            'destination.*' => 'string|in:Egypt,OtherCountries',
            'regions' => 'nullable|array',
            'regions.*' => 'string',
            'countries' => 'nullable|array',
            'countries.*' => 'string',
            'countries_other' => 'nullable|string',
            'social_platforms' => 'nullable|array',
            'social_platforms.*' => 'nullable|url',
            'intro_video' => 'nullable|file|mimes:mp4,mov,mkv|max:153600',
            'sales_video' => 'nullable|file|mimes:mp4,mov,mkv|max:153600',
            'participation_reason' => 'nullable|string',
            'standout_reason' => 'nullable|string',
            // 'terms' => 'accepted',
            // 'consent' => 'accepted',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store files in pending location
        $photoPath = null;
        if ($request->hasFile('profile_photo') && !$request->filled('cropped_profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('pending/photos', 'public');
        } elseif ($request->filled('cropped_profile_photo')) {
            $image = $request->cropped_profile_photo;
            $imageData = substr($image, strpos($image, ',') + 1);
            $imageName = 'pending_user_' . time() . '_cropped.jpg';
            Storage::disk('public')->put('pending/photos/' . $imageName, base64_decode($imageData));
            $photoPath = 'pending/photos/' . $imageName;
        }

        $introVideoPath = null;
        if ($request->hasFile('intro_video')) {
            $file = $request->file('intro_video');
            $fileName = "pending_" . time() . "_intro." . $file->getClientOriginalExtension();
            $introVideoPath = $file->storeAs('pending_videos', $fileName, 'public');
        }

        $salesVideoPath = null;
        if ($request->hasFile('sales_video')) {
            $file = $request->file('sales_video');
            $fileName = "pending_" . time() . "_sales." . $file->getClientOriginalExtension();
            $salesVideoPath = $file->storeAs('pending_videos', $fileName, 'public');
        }

        // Processing arrays (Expertise & Destinations)
        $expertiseAreas = $request->expertise ?? [];
        if ($request->expertise_other) {
            $expertiseAreas['other'] = $request->expertise_other;
        }

        $destinations = [];
        $egyptRegionsAll = ['East Cairo', 'West Cairo', 'New Capital', 'North Coast', 'Red Sea'];
        $regions = $request->regions ?? [];
        if (in_array('All Egypt', $regions, true)) {
            $regions = $egyptRegionsAll;
        }
        // $regions = array_values(array_unique($regions));

        // if (in_array('Egypt', $request->destination) && !empty($regions)) {
        //     $destinations['Egypt'] = $regions;
        // }

        $countries = $request->countries ?? [];
        $countries = array_values(array_filter($countries, fn($country) => $country !== 'Others'));
        $countriesOther = $request->countries_other ?? '';
        $countriesOtherList = array_values(array_filter(array_map('trim', explode(',', $countriesOther))));
        $countries = array_values(array_unique(array_merge($countries, $countriesOtherList)));

        // if (in_array('OtherCountries', $request->destination) && !empty($countries)) {
        //     $destinations['OtherCountries'] = $countries;
        // }

        // Store all data in session
        session([
            'pending_contestant' => [
                'full_name' => $request->full_name, // Needed for User creation later
                'email' => $request->email,         // Needed for User creation later
                'password' => Hash::make($request->password), // Pre-hash for security
                'user_id' => null, // No user created yet
                'profile_photo_path' => $photoPath,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality_id' => $request->nationality_id,
                'phone' => $request->phone,
                'experience' => $request->experience,
                'employer' => $request->employer,
                'expertise_areas' => $expertiseAreas,
                'expertise_other' => $request->expertise_other,
                'destinations' => $destinations,
                'participation_reason' => $request->participation_reason,
                'standout_reason' => $request->standout_reason,
                'social_platforms' => $request->social_platforms ?? [],
                'intro_video_path' => $introVideoPath,
                'sales_video_path' => $salesVideoPath,
            ],
        ]);

        // Generate OTP
        $code = (string) random_int(1000, 9999);

        Otp::updateOrCreate(
            ['phone' => $request->phone],
            [
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]
        );

        session([
            'otp_phone' => $request->phone,
            'otp_sent_at' => now(),
            'debug_code' => $code,
        ]);

        // Send WhatsApp message using WhatsAppService2
        try {
            $whatsapp = app(\App\Services\WhatsAppService::class);
            $whatsapp->send($request->phone, 'كود التحقق الخاص بك هو : ' . $code);
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp (Service2): " . $e->getMessage());
        }

        // Ensure session persistence
        session()->save();

        // Create encrypted fallback token (Phone Only, as User ID doesn't exist)
        $tokenPayload = json_encode(['phone' => $request->phone]);
        $token = Crypt::encryptString($tokenPayload);

        Log::info('Contestant OTP generated (Session Flow)', ['phone' => $request->phone, 'code' => $code]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration initiated! Please verify your phone.',
                'redirect' => route('contestant.otp.form', ['t' => $token])
            ]);
        }

        return view('website.contestant.otp', [
            'phone' => $request->phone,
            'debug_code' => $code,
            'token' => $token,
        ])->with('success', 'تم إرسال كود التحقق ✅');
    }

    /* =========================================================
     | CHECK USER EXISTS
     ========================================================= */
    public function checkUserExists(Request $request)
    {
        return response()->json([
            'email_exists' => User::where('email', $request->email)->exists(),
            'phone_exists' => User::where('phone', $request->phone)->exists(),
        ]);
    }

    /* =========================================================
     | SHOW OTP FORM
     ========================================================= */
    public function showOtpForm(Request $request)
    {
        $phone = session('otp_phone');

        // Restore from token if session missing
        if (!$phone && $request->t) {
            try {
                $payload = Crypt::decryptString($request->t);
                $data = json_decode($payload, true);
                if (!empty($data['phone'])) {
                    $phone = $data['phone'];
                    // NOTE: we cannot restore the full pending_contestant data from just the phone token
                    // unless we assume the session 'pending_contestant' is still there or stored in cache.
                    // If session is completely dead, we might fail to create the user later.
                    // But for simple "cookie dropped" cases, we restore the 'otp_phone'.

                    session(['otp_phone' => $phone]);
                    session()->save();
                }
            } catch (\Exception $e) {
                Log::warning('Failed to decrypt contestant OTP token', ['exception' => $e->getMessage()]);
            }
        }

        if (!$phone || !session()->has('pending_contestant')) {
            return redirect('/contestant/registeration')->withErrors(['otp' => 'الجلسة منتهية أو البيانات مفقودة. يرجى التسجيل مرة أخرى.']);
        }

        return view('website.contestant.otp', [
            'phone' => $phone,
            'debug_code' => session('debug_code'),
            'token' => $request->t ?? null,
        ]);
    }

    /* =========================================================
     | VERIFY OTP (DB WRITE HERE)
     ========================================================= */
    public function verifyOtp(Request $request)
    {
        // Restore session if needed
        if (!session('otp_phone') && $request->t) {
            try {
                $payload = Crypt::decryptString($request->t);
                $data = json_decode($payload, true);
                if (!empty($data['phone'])) {
                    session(['otp_phone' => $data['phone']]);
                    session()->save();
                }
            } catch (\Exception $e) {
            }
        }

        $request->validate([
            'otp' => 'required|digits:4'
        ], [
            'otp.required' => 'الكود مطلوب',
            'otp.digits' => 'الكود لازم يكون 4 أرقام',
        ]);

        $phone = session('otp_phone');
        $pending = session('pending_contestant');

        if (!$phone) {
            return redirect('/contestant/registeration')->withErrors(['otp' => 'الجلسة منتهية']);
        }

        if (!$pending) {
            return redirect('/contestant/registeration')->withErrors(['otp' => 'بيانات التسجيل غير موجودة. يرجى التسجيل مرة أخرى.']);
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

        DB::beginTransaction();

        try {
            // 1. Create User
            // Check uniqueness again just in case
            if (User::where('email', $pending['email'])->exists() || User::where('phone', $pending['phone'])->exists()) {
                throw new \Exception('المستخدم مسجل بالفعل.');
            }

            $user = User::create([
                'name' => $pending['full_name'],
                'phone' => $pending['phone'],
                'email' => $pending['email'],
                'password' => $pending['password'], // Already hashed in register
                'type' => 'contestant',
            ]);

            // 2. Handle File Moves (from pending to real)
            $disk = Storage::disk('public');

            $finalPhotoPath = null;
            if (!empty($pending['profile_photo_path'])) {
                $oldPath = $pending['profile_photo_path'];
                if ($disk->exists($oldPath)) {
                    $newPath = 'photos/user_' . $user->id . '_' . basename($oldPath);
                    $disk->move($oldPath, $newPath);
                    $finalPhotoPath = $newPath;
                }
            }

            $finalIntroPath = null;
            if (!empty($pending['intro_video_path']) && $disk->exists($pending['intro_video_path'])) {
                $ext = pathinfo($pending['intro_video_path'], PATHINFO_EXTENSION);
                $newPath = "videos/{$user->id}_{$user->name}_intro.{$ext}"; // Use temp ID effectively
                $disk->move($pending['intro_video_path'], $newPath);
                $finalIntroPath = $newPath;
            }

            $finalSalesPath = null;
            if (!empty($pending['sales_video_path']) && $disk->exists($pending['sales_video_path'])) {
                $ext = pathinfo($pending['sales_video_path'], PATHINFO_EXTENSION);
                $newPath = "videos/{$user->id}_{$user->name}_sales.{$ext}";
                $disk->move($pending['sales_video_path'], $newPath);
                $finalSalesPath = $newPath;
            }


            // 3. Create Contestant
            $contestant = Contestant::create([
                'user_id' => $user->id,
                'profile_photo_path' => $finalPhotoPath,
                'dob' => $pending['dob'],
                'gender' => $pending['gender'],
                'nationality_id' => $pending['nationality_id'],
                'phone' => $pending['phone'],
                'experience' => $pending['experience'],
                'employer' => $pending['employer'],
                'expertise_areas' => $pending['expertise_areas'],
                'expertise_other' => $pending['expertise_other'],
                'destinations' => $pending['destinations'],
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

            // 4. Create Video Records
            if ($finalIntroPath) {
                ContestantVideo::create([
                    'contestant_id' => $contestant->id,
                    'type' => 'intro',
                    'file_path' => $finalIntroPath,
                    'stage_number' => 0,
                    'video_number' => 1
                ]);
            }

            if ($finalSalesPath) {
                ContestantVideo::create([
                    'contestant_id' => $contestant->id,
                    'type' => 'sales',
                    'file_path' => $finalSalesPath,
                    'stage_number' => 0,
                    'video_number' => 2
                ]);
            }

            // 5. Social Links
            $socialPlatforms = $pending['social_platforms'] ?? [];
            foreach ($socialPlatforms as $platform => $link) {
                if ($link) {
                    ContestantSocial::create([
                        'contestant_id' => $contestant->id,
                        'platform' => $platform,
                        'link' => $link,
                    ]);
                }
            }

            // Cleanup
            $otp->delete();
            session()->forget(['otp_phone', 'otp_sent_at', 'debug_code', 'pending_contestant']);

            // Send Confirmation WhatsApp (Standard Service)
            try {
                $whatsappService = app(\App\Services\WhatsAppService::class);
                $whatsappService->send($pending['phone'], 'Hello, your account is currently under review. You will be notified once the review is completed.');
            } catch (\Exception $e) { /* Ignore notification fail */
            }

            DB::commit();

            // Login
            Auth::login($user);

            return redirect()->route('profile.edit', ['id' => $user->id])
                ->with('success', 'تم تأكيد الرقم وتسجيل الدخول بنجاح ✅');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Contestant creation after OTP failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['otp' => 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage()]);
        }
    }

    /* =========================================================
     | RESEND OTP
     ========================================================= */
    public function resendOtp()
    {
        $phone = session('otp_phone');

        // Restore from token
        if (!$phone && request()->has('t')) {
            try {
                $payload = Crypt::decryptString(request('t'));
                $data = json_decode($payload, true);
                if (!empty($data['phone'])) {
                    session(['otp_phone' => $data['phone']]);
                    session()->save();
                    $phone = $data['phone'];
                }
            } catch (\Exception $e) {
            }
        }

        if (!$phone) {
            return redirect('/contestant/registeration')->withErrors(['otp' => 'الجلسة منتهية']);
        }

        // Rate limit
        $lastSent = session('otp_sent_at');
        if ($lastSent && now()->diffInSeconds($lastSent) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastSent);
            $errors = new \Illuminate\Support\MessageBag(['otp' => "انتظر {$remaining} ثانية"]);
            return view('website.contestant.otp', [
                'phone' => $phone,
                'debug_code' => session('debug_code'),
                'token' => request('t') ?? null,
                'errors' => $errors,
            ]);
        }

        $code = (string) random_int(1000, 9999);
        Otp::updateOrCreate(
            ['phone' => $phone],
            ['code' => $code, 'expires_at' => Carbon::now()->addMinutes(5)]
        );

        session(['otp_sent_at' => now(), 'debug_code' => $code]);

        // Resend using Standard Service (or Service2 if preferred, usually Standard for re-sends)
        try {
            $whatsappService = app(\App\Services\WhatsAppService::class);
            $whatsappService->send($phone, 'كود التحقق الجديد هو : ' . $code);
        } catch (\Exception $e) {
        }

        return view('website.contestant.otp', [
            'phone' => $phone,
            'debug_code' => session('debug_code'),
            'token' => request('t') ?? null,
            'success' => 'تم إرسال كود جديد ✅',
        ]);
    }
}
