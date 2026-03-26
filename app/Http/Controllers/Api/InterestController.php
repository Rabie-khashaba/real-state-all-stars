<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\Contestant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function toggle(Request $request, int $contestantId): JsonResponse
    {
        $user = Auth::user();

        $contestant = Contestant::findOrFail($contestantId);

        $existingInterest = Interest::where('user_id', $user->id)
            ->where('contestant_id', $contestant->id)
            ->first();

        if ($existingInterest) {
            $existingInterest->delete();

            return response()->json([
                'success' => true,
                'message' => 'Interest removed successfully.',
                'isInterested' => false,
            ]);
        }

        Interest::create([
            'user_id' => $user->id,
            'contestant_id' => $contestant->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Interest marked successfully.',
            'isInterested' => true,
        ]);
    }
}
