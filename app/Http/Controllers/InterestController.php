<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\Contestant;
use Illuminate\Support\Facades\Auth;


class InterestController extends Controller
{
    //
    public function toggle(Request $request, $contestantId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to mark interest.'
            ], 401);
        }

        $contestant = Contestant::findOrFail($contestantId);

        $existingInterest = Interest::where('user_id', $user->id)
            ->where('contestant_id', $contestant->id)
            ->first();

        if ($existingInterest) {
            // Remove interest
            $existingInterest->delete();
             return response()->json([
                'success' => true,
                'message' => 'Interest removed successfully.',
                'isInterested' => false
            ]); 

            //return redirect()->back()->with('error', 'Interest removed successfully.');

        }

        // Add interest
        Interest::create([
            'user_id' => $user->id,
            'contestant_id' => $contestant->id
        ]);

         return response()->json([
            'success' => true,
            'message' => 'Interest marked successfully.',
            'isInterested' => true
        ]); 

        //return redirect()->back()->with('success', 'Interest marked successfully.');

    }
}
