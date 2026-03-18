<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\AboutWhoWeAre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $aboutUs = AboutWhoWeAre::first();
        $aboutIntro = AboutIntro::first();

        // Prepare the response data
        $data = [
            'aboutUs' => $aboutUs,
            'aboutIntro' => $aboutIntro ? [
                'id' => $aboutIntro->id,
                'header_ar' => $aboutIntro->header_ar,
                'header_en' => $aboutIntro->header_en,
                'description_ar' => $aboutIntro->description_ar,
                'description_en' => $aboutIntro->description_en,
                'subdescription_ar' => $aboutIntro->subdescription_ar,
                'subdescription_en' => $aboutIntro->subdescription_en,
                'image' => $aboutIntro->image ? config('app.image_domain') . '/storage/' . $aboutIntro->image : null,
                'created_at' => $aboutIntro->created_at,
                'updated_at' => $aboutIntro->updated_at,
            ] : null,
        ];

        return response()->json($data);
    }
}
