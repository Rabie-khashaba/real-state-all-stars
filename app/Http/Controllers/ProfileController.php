<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Contestant;
use App\Models\Project;
use App\Models\UserDailyVote;
use App\Models\Payment;
use App\Models\User;
use App\Models\ProjectDeveloper;
use Carbon\Carbon;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
   public function edit(Request $request, $id): View
    {
        $contestant = Contestant::select([
            'id',
            'user_id',
            'profile_photo_path',
            'dob',
            'gender',
            'nationality_id',
            'phone',
            'experience',
            'employer',
            'expertise_areas',
            'destinations',
            'participation_reason',
            'standout_reason',
            'code',
            'activation_way',
            'status',
            'is_verified'

        ])
        ->with([
            'user:users.id,name,email',
            'socials:contestant_socials.id,contestant_id,platform,link',
            'videos:contestant_videos.id,contestant_id,file_path,youtube_url,stage_number,video_number,type',
            'contestantStageReviews:contestant_stage_reviews.id,contestant_id,stage_number,status,is_winner'
        ])
        ->withCount('votes')
        ->where('user_id', $id)
        ->first();

        /* if ($contestant) {
            // Process profile photo
            $contestant->profile_photo_path = $contestant->profile_photo_path
                ? asset('storage/' . $contestant->profile_photo_path)
                : asset('photos/default.jpg');

            // Set default votes
            $votes = $contestant->votes_count ?? 0;

            // Process social links
            $socialLinks = $contestant->socials->map(function ($social) {
                return "{$social->platform}: {$social->link}";
            })->implode(', ');

            // Process expertise areas for display
            $expertiseAreas = is_array($contestant->expertise_areas)
                ? implode(', ', array_keys(array_filter($contestant->expertise_areas)))
                : ($contestant->expertise_areas ?? 'N/A');

            // Process destinations for display
            $destinations = is_array($contestant->destinations)
                ? implode(', ', $contestant->destinations)
                : ($contestant->destinations ?? 'N/A');

            // Set default values for fields if null
            $contestant->dob = $contestant->dob ?? 'N/A';
            $contestant->gender = $contestant->gender ?? 'N/A';
            $contestant->nationality = $contestant->nationality ?? 'N/A';
            $contestant->phone = $contestant->phone ?? 'N/A';
            $contestant->experience = $contestant->experience ?? 'N/A';
            $contestant->employer = $contestant->employer ?? 'N/A';
            $contestant->participation_reason = $contestant->participation_reason ?? 'N/A';
            $contestant->standout_reason = $contestant->standout_reason ?? 'N/A';

            // Backward compatibility for video URLs (Stage 1)
            $videoUrls = $contestant->videos()->where('stage_number', 1)->pluck('youtube_url')->implode("\n");

            // Determine the highest approved stage where the contestant is a winner
            $winningStage = $contestant->contestantStageReviews
                ->where('status', 'approved')
                ->where('is_winner', 1)
                ->max('stage_number') ?? 0; // Default to 0 if no winning stage

            // Determine if the contestant can upload videos
            $canUploadVideos = false;
            if ($winningStage >= 0) {
                $nextStage = $winningStage + 1;
                $stageVideosCount = $contestant->videos()->where('stage_number', $nextStage)->count();
                $stageRequired = [1 => 2, 2 => 2, 3 => 3, 4 => 4][$nextStage] ?? 2;
                $canUploadVideos = $stageVideosCount < $stageRequired;
            } elseif ($winningStage == 0) {
                // Allow uploads for Stage 1 if no stages have been won yet
                $stageVideosCount = $contestant->videos()->where('stage_number', 1)->count();
                $canUploadVideos = $stageVideosCount < 2;
            }

            // Determine if the user can vote
            $canVote = false;
            if ($request->user()) {
                $dailyVote = UserDailyVote::getTodayRecord($request->user());
                $canVote = $dailyVote->canVote();
            }
            // Fetch projects for dynamic selection
            $projects = Project::select('id', 'name_en')->get();

            return view('profile.edit', [
                'contestant' => $contestant,
                'votes' => $votes,
                'socialLinks' => $socialLinks ?: 'N/A',
                'videoUrls' => $videoUrls ?: null,
                'expertiseAreas' => $expertiseAreas,
                'destinations' => $destinations,
                'stage2VideosCount' => $contestant->videos()->where('stage_number', 2)->count(),
                'canUploadVideos' => $canUploadVideos,
                'canVote' => $canVote,
                'projects' => $projects,
                'winningStage' => $winningStage,
            ]);
        } */

        // If not a contestant, treat as a regular user
        $user = User::findOrFail($id);
        $profilePhotoPath = asset('images/default.svg');

        // Fetch user's completed payments
        $completedPayments = Payment::where('user_id', $id)
            ->where('status', 'completed')
            ->get()
            ->map(function ($payment) {
                $packageNames = [
                    1 => 'Basic Package',
                    2 => 'Premium Package',
                    3 => 'Elite Package',
                ];
                $packageName = $packageNames[$payment->package_id] ?? 'Unknown Package';
                $createdAt = $payment->created_at;
                $expiration = $createdAt->copy()->addMonth();
                $isExpired = $expiration->isPast();

                return [
                    'package_name' => $packageName,
                    'amount' => $payment->amount,
                    'votes_credited' => $payment->votes_credited,
                    'activation_date' => $createdAt,
                    'expiration_date' => $expiration,
                    'is_expired' => $isExpired,
                ];
            });
            
            $developers = ProjectDeveloper::all();
            $contestant = auth()->user()->contestant;

            $requiredVideos = [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
            ];

            $uploadedCounts = [];

            foreach ($requiredVideos as $stage => $required) {
                $uploaded = $contestant?->videos()->where('stage_number', $stage)->count() ?? 0;
                $remaining = max($required - $uploaded, 0);

                $uploadedCounts[$stage] = [
                    'required' => $required,
                    'uploaded' => $uploaded,
                    'remaining' => $remaining,
                ];
            }

        return view('website.profile.index', [
            'user' => $user,
            'profilePhotoPath' => $profilePhotoPath,
            'completedPayments' => $completedPayments,
            'contestant' => $contestant,
            'developers'=> $developers,
            'uploadedCounts'=> $uploadedCounts,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
        public function userProfilePackages() {
        $user = User::findOrFail(request()->user()->id);
        $profilePhotoPath = asset('images/default.svg');
        return view('profile.user-profile-packages', [
            'user' => $user,
            'profilePhotoPath' => $profilePhotoPath,
        ]);
    }
    
    
    public function activate($id, $store)
    {
        $contestant = Contestant::where('id', $id)->first();

        if (!$contestant) {
            return redirect('/')->with('error', 'User not found!');
        }

        // تفعيل الحساب
        $contestant->update([
            'is_verified' => 1,
            'verified_at' => Carbon::now(),
            'activation_way'=>'app',

        ]);

        // تحديد اللينك حسب المتجر
        $redirectUrl = $store === 'apple'
            ? 'https://apps.apple.com/us/app/trc/id6745425360'
            : 'https://play.google.com/store/apps/details?id=com.triple.trc';

        return redirect()->away($redirectUrl);
    }
    
    
    public function show($id)
    {
        $contestant = \App\Models\Contestant::select([
            'id',
            'user_id',
            'profile_photo_path',
            'dob',
            'gender',
            'nationality_id',
            'phone',
            'experience',
            'employer',
            'expertise_areas',
            'destinations',
            'participation_reason',
            'standout_reason',
            'code',
            'activation_way',
            'status',
            'is_verified',
        ])
        ->with([
            'user:id,name,email',
            'socials:id,contestant_id,platform,link',
            'videos:id,contestant_id,file_path,youtube_url,stage_number,video_number,type',
            'contestantStageReviews:id,contestant_id,stage_number,status,is_winner'
        ])
        ->withCount('votes')
        ->where('user_id', $id)
        ->first();

        //return $contestant;

        if (!$contestant) {
            return redirect()->back()->with('error', 'Contestant not found.');
        }

        $user = User::findOrFail($id);
        $profilePhotoPath = asset('images/default.svg');

        //return $user;

        // Fetch user's completed payments
        $completedPayments = Payment::where('user_id', $id)
            ->where('status', 'completed')
            ->get()
            ->map(function ($payment) {
                $packageNames = [
                    1 => 'Basic Package',
                    2 => 'Premium Package',
                    3 => 'Elite Package',
                ];
                $packageName = $packageNames[$payment->package_id] ?? 'Unknown Package';
                $createdAt = $payment->created_at;
                $expiration = $createdAt->copy()->addMonth();
                $isExpired = $expiration->isPast();

                return [
                    'package_name' => $packageName,
                    'amount' => $payment->amount,
                    'votes_credited' => $payment->votes_credited,
                    'activation_date' => $createdAt,
                    'expiration_date' => $expiration,
                    'is_expired' => $isExpired,
                ];
            });


            $developers = ProjectDeveloper::all(); // أو Project::select('id', 'name')->get();

           // $contestant = auth()->user()->contestant;

            $requiredVideos = [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
            ];

            $uploadedCounts = [];

            foreach ($requiredVideos as $stage => $required) {
                $uploaded = $contestant?->videos()->where('stage_number', $stage)->count() ?? 0;
                $remaining = max($required - $uploaded, 0);

                $uploadedCounts[$stage] = [
                    'required' => $required,
                    'uploaded' => $uploaded,
                    'remaining' => $remaining,
                ];
            }

        return view('website.contestant.profile', [
            'user' => $user,
            'profilePhotoPath' => $profilePhotoPath,
            'completedPayments' => $completedPayments,
            'contestant' => $contestant,
            'developers'=> $developers,
            'uploadedCounts'=> $uploadedCounts,
        ]);

    }
    
    
}
