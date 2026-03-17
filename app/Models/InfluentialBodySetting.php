<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluentialBodySetting extends Model
{
    use HasFactory;

    protected $table = 'influential_body_settings';

    protected $fillable = [
        'title_ar',
        'title_en',
        'body1_name',
        'body1_description_ar',
        'body1_description_en',
        'body1_country_ar',
        'body1_country_en',
        'body1_image',
        'body2_name',
        'body2_description_ar',
        'body2_description_en',
        'body2_country_ar',
        'body2_country_en',
        'body2_image',
        'body3_name',
        'body3_description_ar',
        'body3_description_en',
        'body3_country_ar',
        'body3_country_en',
        'body3_image',
        'body4_name',
        'body4_description_ar',
        'body4_description_en',
        'body4_country_ar',
        'body4_country_en',
        'body4_image',
    ];
}
