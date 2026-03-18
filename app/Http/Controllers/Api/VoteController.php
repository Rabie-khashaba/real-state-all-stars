<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\UserDailyVote;
use App\Models\Vote;
use App\Models\ContestantStageReview;
use App\Models\ContestantVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        // المرحلة 1: اللي عندهم فيديوهات في المرحلة الأولى مع youtube_url not empty
        $stage1Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 1)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->get();

        // المرحلة 2: اللي عندهم فيديوهات في المرحلة الثانية مع youtube_url not empty
        $stage2Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 2)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->get();

        // المرحلة 3: اللي عندهم فيديوهات في المرحلة الثالثة مع youtube_url not empty
        $stage3Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 3)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->get();

        // المرحلة 4: اللي عندهم فيديوهات في المرحلة الرابعة مع youtube_url not empty
        $stage4Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 4)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->get();

        // تحديد آخر مرحلة مفتوحة (آخر مرحلة فيها فيديوهات في قاعدة البيانات)
        $highestOpenStage = ContestantVideo::whereNotNull('stage_number')
            ->where('stage_number', '>', 0)
            ->max('stage_number') ?? 1;

        return response()->json([
            'stages' => [
                'stage1' => $stage1Winners,
                'stage2' => $stage2Winners,
                'stage3' => $stage3Winners,
                'stage4' => $stage4Winners,
            ],
            'highestOpenStage' => $highestOpenStage,
        ]);
    }

    public function vote(Request $request, $contestantId)
    {
        $user = Auth::user();
        $contestant = Contestant::findOrFail($contestantId);

        // تحديد آخر مرحلة مفتوحة (آخر مرحلة فيها فيديوهات)
        $highestOpenStage = ContestantVideo::whereNotNull('stage_number')
            ->where('stage_number', '>', 0)
            ->max('stage_number') ?? 1;

        // تحديد آخر مرحلة عند المتسابق رفع فيها فيديو
        $contestantHighestStage = $contestant->videos()
            ->where('stage_number', '>', 0)
            ->max('stage_number') ?? 0;

        // التحقق من وجود فيديو مع youtube_url في آخر مرحلة
        $hasVideoWithUrl = $contestant->videos()
            ->where('stage_number', $contestantHighestStage)
            ->whereNotNull('youtube_url')
            ->exists();

        if (!$hasVideoWithUrl) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكنك التصويت، لا يوجد فيديو متاح في آخر مرحلة.',
            ], 403);
        }

        // البحث عن review لهذه المرحلة بالذات
        $reviewInHighestStage = $contestant->contestantStageReviews()
            ->where('stage_number', $contestantHighestStage)
            ->first();

        // التحقق إذا كان المتسابق فاز في آخر مرحلة وصلها
        $hasWonInHighestStage = $reviewInHighestStage && $reviewInHighestStage->is_winner == true;

        // منع التصويت إذا كان المتسابق فاز في آخر مرحلة وصلها فقط
        if ($hasWonInHighestStage) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكنك التصويت، المتسابق فاز في آخر مرحلة وصلها.',
            ], 403);
        }

        return DB::transaction(function () use ($user, $contestant) {
            $dailyVote = UserDailyVote::getTodayRecord($user);

            if (!$dailyVote->canVote()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have no more votes left for today.',
                ], 403);
            }

            Vote::create([
                'contestant_id' => $contestant->id,
                'user_id' => $user->id,
                'voted_at' => now(),
            ]);

            $dailyVote->useVote();

            return response()->json([
                'success' => true,
                'message' => 'Vote cast successfully.',
                'canVote' => $dailyVote->canVote(),
            ]);
        });
    }

    public function purchaseVotes(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $dailyVote = UserDailyVote::getTodayRecord($user);
        $number = $request->input('number');

        try {
            // Assume payment is successful (integrate with a payment gateway like Stripe)
            $dailyVote->addVotes($number);
            return response()->json([
                'success' => true,
                'message' => 'Additional votes purchased.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllContestants()
    {
        $contestants = Contestant::with(['videos', 'contestantStageReviews'])->withCount('votes')->get();

        $formattedContestants = $contestants->map(function ($contestant) {
            return [
                'id' => $contestant->id,
                'user_id' => $contestant->user_id,
                'nationality_id' => $contestant->nationality_id,
                'profile_photo_path' => $contestant->profile_photo_path ? asset('storage/app/public/' . $contestant->profile_photo_path) : null,
                'dob' => $contestant->dob,
                'gender' => $contestant->gender,
                'phone' => $contestant->phone,
                'experience' => $contestant->experience,
                'employer' => $contestant->employer,
                'expertise_areas' => $contestant->expertise_areas,
                'expertise_other' => $contestant->expertise_other,
                'destinations' => $contestant->destinations,
                'status' => $contestant->status,
                'activation_way' => $contestant->activation_way,
                'code' => $contestant->code,
                'is_verified' => $contestant->is_verified,
                'verified_at' => $contestant->verified_at,
                'expire_at' => $contestant->expire_at,
                'participation_reason' => $contestant->participation_reason,
                'standout_reason' => $contestant->standout_reason,
                'votes_count' => $contestant->votes_count,
                'videos' => $contestant->videos,
                'contestant_stage_reviews' => $contestant->contestant_stage_reviews,
            ];
        });

        return response()->json([
            'contestants' => $formattedContestants,
        ]);
    }
}