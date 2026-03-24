<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use App\Models\ContestantStageReview;
use App\Models\ContestantVideo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContestantVideoController extends Controller
{
    /**
     * Upload videos for stage 2
     */
    public function upload(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'stage_number' => 'required',
            'video_files.*' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:153600', // 150MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get authenticated contestant and user
        $contestant = Contestant::where('user_id', auth()->id())->firstOrFail();
        $user = auth()->user();
        $userName = str_replace(' ', '_', $user->name); // Replace spaces with underscores for file naming

        // Check if user already has 3 videos for stage 2
        $currentVideoCount = $contestant->videos()->where('stage_number', $request->stage_number)->count();

        if ($currentVideoCount >= 4) {
            return response()->json([
                'success' => false,
                'message' => 'You have already uploaded the maximum number of videos (3) for Stage 2.',
            ], 422);
        }

        // Calculate how many more videos can be uploaded
        $remainingSlots = 4 - $currentVideoCount;

        // Process videos
        $uploadedVideos = 0;
        $stageNumber = $request->input('stage_number');

        // Handle file uploads
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $videoNumber => $file) {
                // Stop if we've reached the maximum number of videos
                if ($uploadedVideos >= $remainingSlots) {
                    break;
                }

                // Use unique type for each video (e.g., stage2_video_1, stage2_video_2)
                $nextVideoNumber = $currentVideoCount + $uploadedVideos + 1;
                $type = 'stage'.$stageNumber.'_video_' . $nextVideoNumber;

                // Generate file name: {contestant_id}_{user_name}_{type}.{extension}
                $fileName = "{$contestant->id}_{$userName}_{$type}." . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('videos', $fileName, 'public');

                ContestantVideo::create([
                    'contestant_id' => $contestant->id,
                    'type' => $type, // Unique type per video
                    'file_path' => $filePath,
                    'stage_number' => $stageNumber,
                    'video_number' => $nextVideoNumber // Use sequential numbering
                ]);

                Log::info('Video processed', ['type' => $type, 'path' => $filePath, 'video_number' => $nextVideoNumber]);
                $uploadedVideos++;
            }
        }

        if ($uploadedVideos === 0) {
            return response()->json([
                'success' => false,
                'message' => 'You must provide at least one video.',
            ], 422);
        }

        // Check if user has now reached the maximum
        $newTotalCount = $currentVideoCount + $uploadedVideos;
        $hasReachedMax = $newTotalCount >= 3;

        return response()->json([
            'success' => true,
            'message' => 'Videos uploaded successfully.' . ($hasReachedMax ? ' You have now reached the maximum number of videos for Stage 2.' : ''),
            'videos_count' => $uploadedVideos,
            'total_count' => $newTotalCount,
            'has_reached_max' => $hasReachedMax
        ]);
    }

    /**
     * Check if a phone number already exists
     */
    public function checkPhoneExists(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number format',
            ], 422);
        }

        $phone = $request->input('phone');

        // Check if phone exists in contestants table
        $exists = Contestant::where('phone', $phone)->exists();

        return response()->json([
            'success' => true,
            'exists' => $exists,
            'message' => $exists ? 'This phone number is already registered.' : 'Phone number is available.',
        ]);
    }
    
    
      public function uploadall(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'stage_number' => 'required|integer|min:1|max:4',
            'project_id' => 'required|exists:projects,id',
            'video_files.*' => 'required|file|mimes:mp4,mov,avi,wmv|max:153600',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = auth()->user();
        $contestant = Contestant::where('user_id', $user->id)->first();
    
        if (!$contestant) {
            return redirect()->route('profile.edit', $user->id)
                ->with('error', 'You must complete your contestant profile first before uploading videos.');
        }
    
        $stageNumber = intval($request->stage_number);
    
        // How many videos are allowed per stage
        $maxVideosPerStage = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
        ];
    
        $maxAllowed = $maxVideosPerStage[$stageNumber];
    
        // Count existing videos for this stage
        $currentVideoCount = $contestant->videos()
            ->where('stage_number', $stageNumber)
            ->count();
    
        if ($currentVideoCount >= $maxAllowed) {
            return redirect()->route('profile.edit', $user->id)
                ->with('error', "You already uploaded the maximum number of {$maxAllowed} videos for Stage {$stageNumber}.");
        }
    
        $remainingSlots = $maxAllowed - $currentVideoCount;
        $uploadedVideos = 0;
        $userName = str_replace(' ', '_', $user->name);
    
        // Upload files
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $file) {
    
                if ($uploadedVideos >= $remainingSlots) break;
    
                $nextVideoNumber = $currentVideoCount + $uploadedVideos + 1;
                $type = "stage{$stageNumber}_video_{$nextVideoNumber}";
    
                $fileName = "{$contestant->id}_{$userName}_{$type}." . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('videos', $fileName, 'public');
    
                ContestantVideo::create([
                    'contestant_id' => $contestant->id,
                    'project_id' => $request->project_id,
                    'type' => $type,
                    'file_path' => $filePath,
                    'stage_number' => $stageNumber,
                    'video_number' => $nextVideoNumber
                ]);
    
                $uploadedVideos++;
            }
        }
    
        if ($uploadedVideos === 0) {
            return redirect()->route('profile.edit', $user->id)
                ->with('error', 'You must upload at least one video.');
        }

        ContestantStageReview::updateOrCreate(
            [
                'contestant_id' => $contestant->id,
                'stage_number' => $stageNumber,
            ],
            [
                'status' => 'pending',
                'rejection_reason' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
                'is_winner' => false,
                'winnered_by' => null,
                'winnered_at' => null,
            ]
        );
    
        return redirect()->route('profile.edit', $user->id)
            ->with('success', "Videos uploaded successfully for Stage {$stageNumber}!");
    }

}
