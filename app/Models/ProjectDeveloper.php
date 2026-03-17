<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDeveloper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'logo',
        'roles',
        'is_visible'
    ];

    protected $casts = [
        'roles' => 'array',
    ];


    // في ProjectDeveloper.php
    public function projects()
    {
        return $this->hasMany(Project::class, 'developer_id');
    }


}
