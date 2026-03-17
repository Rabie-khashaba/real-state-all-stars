<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgeSetting extends Model
{
    use HasFactory;

    protected $table = 'judge_settings';

    protected $fillable = [
        'title_ar',
        'title_en',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
