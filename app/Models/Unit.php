<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;


     protected $fillable = [
        'developer_id',
        'project_id',
        'unit_type_id',
        'name_en',
        'name_ar',
        'bedrooms',
        'bathrooms',
        'area',
        'price',
        'about_en',
        'about_ar',
        'master_plan',
        'brochure',
        'down_payment_percentage',
        'number_of_years',
        'photos',
        'main_photo',
        'is_visible'
    ];

    protected $casts = [
        'photos' => 'array',
    ];
    
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar'
            ? ($this->name_ar ?? 'وحدة بدون اسم')
            : ($this->name_en ?? 'Unnamed Unit');
    }

    public function developer()
    {
        return $this->belongsTo(ProjectDeveloper::class, 'developer_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'unit_type_id');
    }

}
