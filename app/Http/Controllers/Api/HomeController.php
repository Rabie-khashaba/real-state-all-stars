<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\Project;
use App\Models\Header;
use App\Models\OurProgram;
use App\Models\ProjectDeveloper;
use App\Models\Countdown;
use App\Models\Footer;
use App\Models\VoteSetting;
use App\Models\PrizeSetting;
use App\Models\JudgeSetting;
use App\Models\InfluentialBodySetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getCounts()
    {
        $contestantsCount = Contestant::count();
        $votesCount = Vote::count();
        $projectsCount = Project::count();

        return response()->json([
            'data' => [
                'contestantsCount' => $contestantsCount,
                'votesCount' => $votesCount,
                'projectsCount' => $projectsCount,
            ]
        ]);
    }

    public function getHeader()
    {
        $header = Header::first();
        $data = $header ? [
            'id' => $header->id,
            'text_ar' => $header->text_ar ?? null,
            'text_en' => $header->text_en ?? null,
            'description_ar' => $header->description_ar ?? null,
            'description_en' => $header->description_en ?? null,
            'image' => $header->image ? config('app.image_domain') . '/storage/' . $header->image : null,
            'created_at' => $header->created_at,
            'updated_at' => $header->updated_at,
        ] : null;

        return response()->json(['header' => $data]);
    }

    public function getOurProgram()
    {
        $ourProgram = OurProgram::first();
        $data = $ourProgram ? [
            'id' => $ourProgram->id,
            'welcome_ar' => $ourProgram->welcome_ar ?? null,
            'welcome_en' => $ourProgram->welcome_en ?? null,
            'title_ar' => $ourProgram->title_ar ?? null,
            'title_en' => $ourProgram->title_en ?? null,
            'description_ar' => $ourProgram->description_ar ?? null,
            'description_en' => $ourProgram->description_en ?? null,
            'image' => $ourProgram->image ? config('app.image_domain') . '/storage/' . $ourProgram->image : null,
            'created_at' => $ourProgram->created_at,
            'updated_at' => $ourProgram->updated_at,
        ] : null;

        return response()->json(['ourProgram' => $data]);
    }

    public function getDevelopers()
    {
        $developers = ProjectDeveloper::all();
        $data = $developers->map(function($developer) {
            return [
                'id' => $developer->id,
                'logo_path' => $developer->logo ? config('app.image_domain') . '/storage/' . $developer->logo : null,
                'name_ar' => $developer->name_ar ?? null,
                'name_en' => $developer->name_en ?? null,
                'short_description_ar' => $developer->description_ar ?? null,
                'short_description_en' => $developer->description_en ?? null,
                'long_description_ar' => $developer->description_ar ?? null,
                'long_description_en' => $developer->description_en ?? null,
                'is_partner' => $developer->is_visible ?? null, // assuming is_visible as is_partner
                'is_sponsor' => $developer->is_visible ?? null, // assuming
                'created_at' => $developer->created_at,
                'updated_at' => $developer->updated_at,
            ];
        });

        return response()->json(['developers' => $data]);
    }

    public function getCountdown()
    {
        $countdown = Countdown::first();
        return response()->json(['countdown' => $countdown]);
    }

    public function getFooter()
    {
        $footer = Footer::first();
        $data = $footer ;

        return response()->json(['footer' => $data]);
    }

    public function getVoteSetting()
    {
        $vote = VoteSetting::first();
        $data = $vote ? [
            'id' => $vote->id,
            'header_ar' => $vote->header_ar ?? null,
            'header_en' => $vote->header_en ?? null,
            'description_ar' => $vote->description_ar ?? null,
            'description_en' => $vote->description_en ?? null,
            'image' => $vote->image ? config('app.image_domain') . '/storage/' . $vote->image : null,
            'created_at' => $vote->created_at,
            'updated_at' => $vote->updated_at,
        ] : null;

        return response()->json(['vote' => $data]);
    }

    public function getPrizeSetting()
    {
        $prize = PrizeSetting::first();
        $data = $prize ? [
            'id' => $prize->id,
            'title_ar' => $prize->title_ar ?? null,
            'title_en' => $prize->title_en ?? null,
            'extra_text_ar' => $prize->extra_text_ar ?? null,
            'extra_text_en' => $prize->extra_text_en ?? null,
            'extra_amount' => $prize->extra_amount ?? null,
            'prize1_amount' => $prize->prize1_amount ?? null,
            'prize1_image' => $prize->prize1_image ? config('app.image_domain') . '/storage/' . $prize->prize1_image : null,
            'prize2_amount' => $prize->prize2_amount ?? null,
            'prize2_image' => $prize->prize2_image ? config('app.image_domain') . '/storage/' . $prize->prize2_image : null,
            'prize3_amount' => $prize->prize3_amount ?? null,
            'prize3_image' => $prize->prize3_image ? config('app.image_domain') . '/storage/' . $prize->prize3_image : null,
            'prize4_amount' => $prize->prize4_amount ?? null,
            'prize4_image' => $prize->prize4_image ? config('app.image_domain') . '/storage/' . $prize->prize4_image : null,
            'prize5_amount' => $prize->prize5_amount ?? null,
            'prize5_image' => $prize->prize5_image ? config('app.image_domain') . '/storage/' . $prize->prize5_image : null,
            'created_at' => $prize->created_at,
            'updated_at' => $prize->updated_at,
        ] : null;

        return response()->json(['prize' => $data]);
    }

    public function getJudgeSettings()
    {
        $judgeSettings = JudgeSetting::first();
        $data = $judgeSettings ? [
            'id' => $judgeSettings->id,
            'title_ar' => $judgeSettings->title_ar ?? null,
            'title_en' => $judgeSettings->title_en ?? null,
            'images' => $judgeSettings->images ? array_map(function($image) {
                return config('app.image_domain') . '/storage/' . $image;
            }, $judgeSettings->images) : [],
            'created_at' => $judgeSettings->created_at,
            'updated_at' => $judgeSettings->updated_at,
        ] : null;

        return response()->json(['judgeSettings' => $data]);
    }

    public function getInfluentialBodySetting()
    {
        $influentialBodySetting = InfluentialBodySetting::first();
        $data = $influentialBodySetting ? [
            'id' => $influentialBodySetting->id,
            'title_ar' => $influentialBodySetting->title_ar ?? null,
            'title_en' => $influentialBodySetting->title_en ?? null,
            'body1_name' => $influentialBodySetting->body1_name ?? null,
            'body1_description_ar' => $influentialBodySetting->body1_description_ar ?? null,
            'body1_description_en' => $influentialBodySetting->body1_description_en ?? null,
            'body1_country_ar' => $influentialBodySetting->body1_country_ar ?? null,
            'body1_country_en' => $influentialBodySetting->body1_country_en ?? null,
            'body1_image' => $influentialBodySetting->body1_image ? config('app.image_domain') . '/storage/' . $influentialBodySetting->body1_image : null,
            'body2_name' => $influentialBodySetting->body2_name ?? null,
            'body2_description_ar' => $influentialBodySetting->body2_description_ar ?? null,
            'body2_description_en' => $influentialBodySetting->body2_description_en ?? null,
            'body2_country_ar' => $influentialBodySetting->body2_country_ar ?? null,
            'body2_country_en' => $influentialBodySetting->body2_country_en ?? null,
            'body2_image' => $influentialBodySetting->body2_image ? config('app.image_domain') . '/storage/' . $influentialBodySetting->body2_image : null,
            'body3_name' => $influentialBodySetting->body3_name ?? null,
            'body3_description_ar' => $influentialBodySetting->body3_description_ar ?? null,
            'body3_description_en' => $influentialBodySetting->body3_description_en ?? null,
            'body3_country_ar' => $influentialBodySetting->body3_country_ar ?? null,
            'body3_country_en' => $influentialBodySetting->body3_country_en ?? null,
            'body3_image' => $influentialBodySetting->body3_image ? config('app.image_domain') . '/storage/' . $influentialBodySetting->body3_image : null,
            'body4_name' => $influentialBodySetting->body4_name ?? null,
            'body4_description_ar' => $influentialBodySetting->body4_description_ar ?? null,
            'body4_description_en' => $influentialBodySetting->body4_description_en ?? null,
            'body4_country_ar' => $influentialBodySetting->body4_country_ar ?? null,
            'body4_country_en' => $influentialBodySetting->body4_country_en ?? null,
            'body4_image' => $influentialBodySetting->body4_image ? config('app.image_domain') . '/storage/' . $influentialBodySetting->body4_image : null,
            'created_at' => $influentialBodySetting->created_at,
            'updated_at' => $influentialBodySetting->updated_at,
        ] : null;

        return response()->json(['influentialBodySetting' => $data]);
    }
}