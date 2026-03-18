<?php

namespace App\Http\Controllers;

use App\Models\JudgeCon;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    /**
     * Display the specified judge profile.
     */

    public function index(){

        $judges = JudgeCon::all();
        return view ('website.judge.index2' , compact('judges'));
    }


    public function show($id)
    {
        $judge = JudgeCon::findOrFail($id);
        $otherJudges = JudgeCon::where('id', '!=', $judge->id)->get();

        return view('website.judge.profile', compact('judge', 'otherJudges'));
    }
}