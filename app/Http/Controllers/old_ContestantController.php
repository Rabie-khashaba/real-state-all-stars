<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Contestant;
use App\Models\ContestantVideo;
use App\Models\ContestantSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use FFMpeg\FFProbe; // Use laravel-ffmpeg package for video duration
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ContestantController extends Controller
{
    //
    public function register(Request $request)
    {
        dd($request->all());
        $request->validate([
            'profile_photo' => 'nullable|image|max:2048', // 2MB max
            'cropped_profile_photo' => 'nullable|string',
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|unique:users,email', // Keep email for records
            'password' => 'required|string|min:8|confirmed',
            'experience' => 'required|string',
            'employer' => 'nullable|string',
            'expertise' => 'required|array',
            'expertise_other' => 'nullable|string',
            'destination' => 'required|string',
            'regions' => 'nullable|array',
            'countries' => 'nullable|array',
            'social_platforms' => 'nullable|array',
            'intro_video' => 'required|file|mimes:mp4,mov|max:153600', // 150MB max
            'sales_video' => 'required|file|mimes:mp4,mov|max:153600', // 150MB max
            'terms' => 'accepted',
            'consent' => 'accepted',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email, // Store email but not used for auth
            'password' => Hash::make($request->password),
        ]);

        // Handle Profile Photo
        $photoPath = null;
        if ($request->hasFile('profile_photo') && !$request->filled('cropped_profile_photo')) {
            // Process normal file upload
            $photoPath = $request->file('profile_photo')->store('photos', 'public');
        } elseif ($request->filled('cropped_profile_photo')) {
            // Process cropped image from data URL
            $image = $request->cropped_profile_photo;
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'user_'.$user->id.'_'.time().'_cropped.jpg';

            // Save cropped image
            Storage::disk('public')->put('photos/'.$imageName, base64_decode($image));
            $photoPath = 'photos/'.$imageName;
        }

        // Prepare expertise and destinations
        $expertiseAreas = $request->expertise ?? [];
        if ($request->expertise_other) {
            $expertiseAreas['other'] = $request->expertise_other;
        }

        // Handle destination selection logic
        $destinations = [];
        if ($request->destination === 'Egypt' && !empty($request->regions)) {
            $destinations = $request->regions;
        } elseif ($request->destination === 'OtherCountries' && !empty($request->countries)) {
            $destinations = $request->countries;
        }

        // Create Contestant
        $contestant = Contestant::create([
            'user_id' => $user->id,
            'profile_photo_path' => $photoPath,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'employer' => $request->employer,
            'expertise_areas' => $expertiseAreas,
            'expertise_other' => $request->expertise_other,
            'destinations' => $destinations,
            'code' => Str::random(6),
            'expire_at' => now()->addDays(7),
        ]);

        try {
            // Handle Video Uploads with Duration Check
            $videos = [
                ['file' => $request->file('intro_video'), 'type' => 'intro', 'max_duration' => 30],
                ['file' => $request->file('sales_video'), 'type' => 'sales', 'max_duration' => 60],
            ];

            foreach ($videos as $video) {
                $file = $video['file'];
                $type = $video['type'];
                $maxDuration = $video['max_duration'];

                try {
                    $ffprobe = FFProbe::create();
                    $duration = $ffprobe->format($file->getPathname())->get('duration');

                    if ($duration > $maxDuration) {
                        // Delete created user and contestant if video is too long
                        $user->delete();
                        return back()->withErrors(["{$type}_video" => "The {$type} video must not exceed {$maxDuration} seconds."])->withInput();
                    }

                    $fileName = "{$contestant->id}_{$user->name}_{$type}." . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('videos', $fileName, 'public');

                    ContestantVideo::create([
                        'contestant_id' => $contestant->id,
                        'type' => $type,
                        'file_path' => $filePath,
                    ]);
                } catch (\Exception $e) {
                    // Log error and proceed (video duration check failure)
                    \Illuminate\Support\Facades\Log::error('Failed to check video duration: ' . $e->getMessage());

                    // Still store the video
                    $fileName = "{$contestant->id}_{$user->name}_{$type}." . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('videos', $fileName, 'public');

                    ContestantVideo::create([
                        'contestant_id' => $contestant->id,
                        'type' => $type,
                        'file_path' => $filePath,
                    ]);
                }
            }

            // Handle Social Media Links
            if ($request->social_platforms) {
                foreach ($request->social_platforms as $platform => $link) {
                    if ($link) {
                        ContestantSocial::create([
                            'contestant_id' => $contestant->id,
                            'platform' => $platform,
                            'link' => $link,
                        ]);
                    }
                }
            }

            // Log the user in
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Registration successful! Please verify your account.');

        } catch (\Exception $e) {
            // If something goes wrong, delete the user and contestant
            $user->delete();
            \Illuminate\Support\Facades\Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred during registration. Please try again.'])->withInput();
        }
    }
}