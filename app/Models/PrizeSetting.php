<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrizeSetting extends Model
{
    use HasFactory;

    protected $table = 'prize_settings';

    protected $fillable = [
        'title_ar',
        'title_en',
        'extra_text_ar',
        'extra_text_en',
        'extra_amount',
        'prize1_amount',
        'prize1_image',
        'prize2_amount',
        'prize2_image',
        'prize3_amount',
        'prize3_image',
        'prize4_amount',
        'prize4_image',
        'prize5_amount',
        'prize5_image',
    ];
}
