<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteSetting extends Model
{
    use HasFactory;
    protected $table = 'vote_settings';
    protected $fillable = [
        'header_ar',
        'header_en',
        'description_ar',
        'description_en',
        'image',
    ];
}
