<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutIntro extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_ar',
        'header_en',
        'description_ar',
        'description_en',
        'subdescription_ar',
        'subdescription_en',
        'image',
    ];

    protected $table = 'about_intros';
}
