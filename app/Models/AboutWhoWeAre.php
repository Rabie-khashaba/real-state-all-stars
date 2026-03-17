<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutWhoWeAre extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_ar',
        'header_en',
        'subtitle_ar',
        'subtitle_en',
        'content_ar',
        'content_en',
    ];
    protected $table = 'about_who_we_ares';
}
