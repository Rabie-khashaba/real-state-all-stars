<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestantSetting extends Model
{
    use HasFactory;
    protected $fillable = ['image_path'];

    protected $table = 'contestant_settings';
}