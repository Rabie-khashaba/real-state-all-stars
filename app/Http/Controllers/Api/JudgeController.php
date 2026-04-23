<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JudgeCon;
use App\Models\Judge;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    protected function formatJudgeApplication(Judge $judge): array
    {
        return [
            'id' => $judge->id,
            'full_name' => $judge->full_name,
            'professional_title' => $judge->professional_title,
            'email' => $judge->email,
            'phone' => $judge->phone,
            'company' => $judge->company,
            'areas_of_expertise' => $judge->areas_of_expertise,
            'experience_description' => $judge->experience_description,
            'document_path' => $judge->document_path,
            'document_url' => $judge->document_path ? asset('storage/' . ltrim($judge->document_path, '/')) : null,
            'created_at' => $judge->created_at,
            'updated_at' => $judge->updated_at,
        ];
    }

    public function index()
    {
        $judges = JudgeCon::all();
        $data = $judges->map(function($judge) {
            return [
                'id' => $judge->id,
                'name_ar' => $judge->name_ar ?? null,
                'name_en' => $judge->name_en ?? null,
                'photo' => $judge->photo ? config('app.image_domain') . '/storage/' . $judge->photo : null,
                'logo' => $judge->logo ? config('app.image_domain') . '/storage/' . $judge->logo : null,
                'title_ar' => $judge->title_ar ?? null,
                'title_en' => $judge->title_en ?? null,
                'bio_ar' => $judge->bio_ar ?? null,
                'bio_en' => $judge->bio_en ?? null,
                'photo_url' => $judge->photo_url, // Using the accessor
                'created_at' => $judge->created_at,
                'updated_at' => $judge->updated_at,
            ];
        });

        return response()->json(['judges' => $data]);
    }

    public function show($id)
    {
        $judge = JudgeCon::find($id);
        if (!$judge) {
            return response()->json(['message' => 'Judge not found'], 404);
        }

        $data = [
            'id' => $judge->id,
            'name_ar' => $judge->name_ar ?? null,
            'name_en' => $judge->name_en ?? null,
            'photo' => $judge->photo ? config('app.image_domain') . '/storage/' . $judge->photo : null,
            'logo' => $judge->logo ? config('app.image_domain') . '/storage/' . $judge->logo : null,
            'title_ar' => $judge->title_ar ?? null,
            'title_en' => $judge->title_en ?? null,
            'bio_ar' => $judge->bio_ar ?? null,
            'bio_en' => $judge->bio_en ?? null,
            'photo_url' => $judge->photo_url,
            'created_at' => $judge->created_at,
            'updated_at' => $judge->updated_at,
        ];

        return response()->json(['judge' => $data]);
    }

    public function others($id)
    {
        $judge = JudgeCon::find($id);
        if (!$judge) {
            return response()->json(['message' => 'Judge not found'], 404);
        }

        $otherJudges = JudgeCon::where('id', '!=', $judge->id)->get()->map(function($otherJudge) {
            return [
                'id' => $otherJudge->id,
                'name_ar' => $otherJudge->name_ar ?? null,
                'name_en' => $otherJudge->name_en ?? null,
                'photo' => $otherJudge->photo ? config('app.image_domain') . '/storage/' . $otherJudge->photo : null,
                'logo' => $otherJudge->logo ? config('app.image_domain') . '/storage/' . $otherJudge->logo : null,
                'title_ar' => $otherJudge->title_ar ?? null,
                'title_en' => $otherJudge->title_en ?? null,
                'bio_ar' => $otherJudge->bio_ar ?? null,
                'bio_en' => $otherJudge->bio_en ?? null,
                'photo_url' => $otherJudge->photo_url,
                'created_at' => $otherJudge->created_at,
                'updated_at' => $otherJudge->updated_at,
            ];
        });

        return response()->json(['otherJudges' => $otherJudges]);
    }

    public function applications()
    {
        $judges = Judge::latest()->get()->map(function (Judge $judge) {
            return $this->formatJudgeApplication($judge);
        });

        return response()->json(['judges' => $judges]);
    }

    public function application($id)
    {
        $judge = Judge::find($id);

        if (!$judge) {
            return response()->json(['message' => 'Judge application not found'], 404);
        }

        return response()->json([
            'judge' => $this->formatJudgeApplication($judge),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'professional_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'areas_of_expertise' => 'nullable|array',
            'areas_of_expertise.*' => 'nullable|string|max:255',
            'other_expertise' => 'nullable|string|max:255',
            'experience_description' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $areas = $data['areas_of_expertise'] ?? [];
        if (!empty($data['other_expertise'])) {
            $areas[] = $data['other_expertise'];
        }

        $judge = new Judge();
        $judge->full_name = $data['full_name'];
        $judge->professional_title = $data['professional_title'] ?? null;
        $judge->email = $data['email'] ?? null;
        $judge->phone = $data['phone'] ?? null;
        $judge->company = $data['company'] ?? null;
        $judge->areas_of_expertise = $areas ?? null;
        $judge->experience_description = $data['experience_description'] ?? null;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('judges_documents', 'public');
            $judge->document_path = $path;
        }

        $judge->save();

        return response()->json([
            'message' => 'Your application has been submitted successfully.',
            'judge' => $judge
        ], 201);
    }
}
