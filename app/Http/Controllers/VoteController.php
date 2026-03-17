<?php

namespace App\Http\Controllers;

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
        //$this->middleware('auth');
    }


    public function index()
    {
        // المرحلة 1: اللي فازوا في المرحلة الأولى فقط
        // $stage1Winners = Contestant::whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 1)->where('is_winner', true);
        // })->withCount('votes')->paginate(10);

        // // المرحلة 2: اللي فازوا في المرحلتين 1 و 2
        // $stage2Winners = Contestant::whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 1)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 2)->where('is_winner', true);
        // })->withCount('votes')->paginate(10);

        // // المرحلة 3: اللي فازوا في 1 و 2 و 3
        // $stage3Winners = Contestant::whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 1)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 2)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 3)->where('is_winner', true);
        // })->withCount('votes')->paginate(10);

        // // المرحلة 4: اللي فازوا في 1 و 2 و 3 و 4
        // $stage4Winners = Contestant::whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 1)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 2)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 3)->where('is_winner', true);
        // })->whereHas('contestantStageReviews', function ($q) {
        //     $q->where('stage_number', 4)->where('is_winner', true);
        // })->withCount('votes')->paginate(10);
        
        
        // المرحلة 1: اللي عندهم فيديوهات في المرحلة الأولى
        // $stage1Winners = Contestant::whereHas('videos', function ($q) {
        //     $q->where('stage_number', 1);
        // })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // // المرحلة 2: اللي عندهم فيديوهات في المرحلة الثانية
        // $stage2Winners = Contestant::whereHas('videos', function ($q) {
        //     $q->where('stage_number', 2);
        // })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // // المرحلة 3: اللي عندهم فيديوهات في المرحلة الثالثة
        // $stage3Winners = Contestant::whereHas('videos', function ($q) {
        //     $q->where('stage_number', 3);
        // })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // // المرحلة 4: اللي عندهم فيديوهات في المرحلة الرابعة
        // $stage4Winners = Contestant::whereHas('videos', function ($q) {
        //     $q->where('stage_number', 4);
        // })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);
        
        
        
        // المرحلة 1: اللي عندهم فيديوهات في المرحلة الأولى مع youtube_url not empty
        $stage1Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 1)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // المرحلة 2: اللي عندهم فيديوهات في المرحلة الثانية مع youtube_url not empty
        $stage2Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 2)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // المرحلة 3: اللي عندهم فيديوهات في المرحلة الثالثة مع youtube_url not empty
        $stage3Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 3)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // المرحلة 4: اللي عندهم فيديوهات في المرحلة الرابعة مع youtube_url not empty
        $stage4Winners = Contestant::whereHas('videos', function ($q) {
            $q->where('stage_number', 4)->whereNotNull('youtube_url')->where('youtube_url', '!=', '');
        })->with(['videos', 'contestantStageReviews'])->withCount('votes')->paginate(10);

        // تحديد آخر مرحلة مفتوحة (آخر مرحلة فيها فيديوهات في قاعدة البيانات)
        $highestOpenStage = ContestantVideo::whereNotNull('stage_number')
            ->where('stage_number', '>', 0)
            ->max('stage_number') ?? 1;
        
        


        //return $stage1Winners;
        

        return view('website.vote.index', compact(
            'stage1Winners',
            'stage2Winners',
            'stage3Winners',
            'stage4Winners',
            'highestOpenStage'
        ));
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
        
        
        
        //return $contestant;

        // if ($user->id === $contestant->user_id) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You cannot vote for yourself.',
        //     ], 403);
        // }

        return DB::transaction(function () use ($user, $contestant, $request) {
            $dailyVote = UserDailyVote::getTodayRecord($user);

            /* if (!$dailyVote->canVote()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have no more votes left for today.',
                ], 403);
            } */

            if (!$dailyVote->canVote()) {
                return redirect()->back()->with('error', 'You have no more votes left for today.');
            }


            Vote::create([
                'contestant_id' => $contestant->id,
                'user_id' => $user->id,
                'voted_at' => now(),
            ]);

            $dailyVote->useVote();

           /*  return response()->json([
                'success' => true,
                'message' => 'Vote cast successfully.',
                'canVote' => $dailyVote->canVote(), // Update frontend button state
            ]); */


        return redirect()->back()->with('success', 'Vote cast successfully.');

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
            return back()->with('success', 'Additional votes purchased.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
