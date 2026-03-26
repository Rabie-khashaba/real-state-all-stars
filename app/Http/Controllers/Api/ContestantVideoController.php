<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\ContestantStageReview;
use App\Models\ContestantVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContestantVideoController extends Controller
{
    public function index(): JsonResponse
    {
        $videos = ContestantVideo::with(['contestant.user'])
            ->orderBy('contestant_id')
            ->orderBy('stage_number')
            ->orderBy('video_number')
            ->get();

        $data = $videos->map(function ($video) {
            return [
                'id' => $video->id,
                'contestant_id' => $video->contestant_id,
                'project_id' => $video->project_id,
                'type' => $video->type,
                'stage_number' => $video->stage_number,
                'video_number' => $video->video_number,
                'file_path' => $video->file_path,
                'file_url' => $video->file_path ? asset('storage/' . $video->file_path) : null,
                'youtube_url' => $video->youtube_url,
                'contestant' => $video->contestant ? [
                    'id' => $video->contestant->id,
                    'user_id' => $video->contestant->user_id,
                    'name' => $video->contestant->user ? $video->contestant->user->name : null,
                ] : null,
                'created_at' => $video->created_at,
                'updated_at' => $video->updated_at,
            ];
        });

        return response()->json([
            'videos' => $data,
        ]);
    }

    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stage_number' => 'required|integer|min:1|max:4',
            'project_id' => 'required|exists:projects,id',
            'video_files' => 'required|array|min:1',
            'video_files.*' => 'required|file|mimes:mp4,mov,avi,wmv,mkv|max:153600',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->user();
        $contestant = Contestant::where('user_id', $user->id)->first();

        if (!$contestant) {
            return response()->json([
                'success' => false,
                'message' => 'You must complete your contestant profile first before uploading videos.',
            ], 422);
        }

        $stageNumber = (int) $request->stage_number;
        $maxVideosPerStage = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
        ];
        $maxAllowed = $maxVideosPerStage[$stageNumber];

        $currentVideoCount = $contestant->videos()
            ->where('stage_number', $stageNumber)
            ->count();

        if ($currentVideoCount >= $maxAllowed) {
            return response()->json([
                'success' => false,
                'message' => "You already uploaded the maximum number of {$maxAllowed} videos for Stage {$stageNumber}.",
            ], 422);
        }

        $remainingSlots = $maxAllowed - $currentVideoCount;
        $uploadedVideos = [];
        $userName = str_replace(' ', '_', $user->name);

        foreach ($request->file('video_files') as $file) {
            if (count($uploadedVideos) >= $remainingSlots) {
                break;
            }

            $nextVideoNumber = $currentVideoCount + count($uploadedVideos) + 1;
            $type = "stage{$stageNumber}_video_{$nextVideoNumber}";
            $fileName = "{$contestant->id}_{$userName}_{$type}." . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('videos', $fileName, 'public');

            $video = ContestantVideo::create([
                'contestant_id' => $contestant->id,
                'project_id' => $request->project_id,
                'type' => $type,
                'file_path' => $filePath,
                'stage_number' => $stageNumber,
                'video_number' => $nextVideoNumber,
            ]);

            $uploadedVideos[] = [
                'id' => $video->id,
                'type' => $video->type,
                'stage_number' => $video->stage_number,
                'video_number' => $video->video_number,
                'file_path' => $video->file_path,
                'file_url' => asset('storage/' . $video->file_path),
            ];
        }

        if ($uploadedVideos === []) {
            return response()->json([
                'success' => false,
                'message' => 'You must upload at least one video.',
            ], 422);
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

        return response()->json([
            'success' => true,
            'message' => "Videos uploaded successfully for Stage {$stageNumber}!",
            'data' => [
                'stage_number' => $stageNumber,
                'uploaded_count' => count($uploadedVideos),
                'total_count' => $currentVideoCount + count($uploadedVideos),
                'max_allowed' => $maxAllowed,
                'videos' => $uploadedVideos,
            ],
        ]);
    }
}
