<?php

namespace App\Http\Controllers;

use App\Models\AreaSetting;
use App\Models\CountrySetting;
use App\Models\ProjectDeveloper;
use App\Models\Project;
use App\Models\Unit;
use App\Models\ContestantVideo;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // جلب جميع الدول و المناطق والمطورين لتعبئة الـ selects
        $countries = CountrySetting::all();
        $areas = AreaSetting::all();
        $allDevelopers = ProjectDeveloper::get();

        // جلب المطورين اللي عندهم مشاريع فقط
        // جلب المطورين اللي عندهم مشاريع فقط مع عدد المشاريع وعدد الوحدات
        $developers = ProjectDeveloper::withCount('projects')
            ->with(['projects' => function($q) {
                $q->withCount('units');
            }])
            ->whereHas('projects', function ($q) use ($request) {
                if ($request->filled('country')) {
                    $q->where('country_id', $request->country);
                }
                if ($request->filled('area')) {
                    $q->where('area_id', $request->area);
                }
            })
            ->when($request->filled('developer_id'), function($q) use ($request) {
                $q->where('id', $request->developer_id);
            })
            ->get();


        return view('website.developer.index', compact('developers', 'countries', 'areas', 'allDevelopers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
     public function show(Request $request,string $id)
    {
        $developer = ProjectDeveloper::findorFail($id);
        $projects = $developer->projects()
        ->when($request->competition, function ($query) use ($request) {
            if ($request->competition === 'in') {
                $query->where('competition_status', 'in_competition');
            } elseif ($request->competition === 'out') {
                $query->where('competition_status', 'out_competition');
            }
        })
        ->get();
        return view('website.developer.developer_details' , compact('developer','projects'));
    }


    public function project_details($id){
       $project = Project::with('units.unitType')->findOrFail($id);
       
       // جلب الفيديوهات المرتبطة بهذا المشروع
        $videos = ContestantVideo::where('project_id', $project->id)
            ->whereNotNull('youtube_url')
            ->get();

        return view('website.developer.projectDetails' ,compact('project','videos'));
    }
    
    public function unit_details($id){

        $unit = Unit::with('project')->findOrFail($id);
        $projectUnits = Unit::where('project_id', $unit->project_id)
                    ->where('id', '!=', $unit->id)
                    ->get();

        
        return view('website.developer.unitDetails' ,compact('unit','projectUnits'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    
    public function getDeveloperProjects($id)
    {
       // $developer = ProjectDeveloper::with('projects')->findOrFail($id);
       $developer = ProjectDeveloper::with([
            'projects' => function ($query) {
                $query->where('competition_status', 'in_competition');
            }
        ])->findOrFail($id);


        return response()->json([
            'success' => true,
            'projects' => $developer->projects
        ]);
    }
}
