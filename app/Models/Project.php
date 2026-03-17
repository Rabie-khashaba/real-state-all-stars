<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

     protected $fillable = [
        'developer_id',
        'country_id',
        'city_id',
        'area_id',
        'name_en',
        'name_ar',
        'short_description_en',
        'short_description_ar',
        'overview_en',
        'overview_ar',
        'interior_details_en',
        'interior_details_ar',
        'master_plan',
        'brochure',
        'map_url',
        'main_photo',
        'photos',
        'competition_status',
        'is_visible'
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function developer()
    {
        return $this->belongsTo(ProjectDeveloper::class);
    }

    public function country()
    {
        return $this->belongsTo(CountrySetting::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(AreaSetting::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'project_id');
    }

}
