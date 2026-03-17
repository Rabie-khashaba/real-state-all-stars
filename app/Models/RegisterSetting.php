<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterSetting extends Model
{
    use HasFactory;

    protected $table = 'register_settings';

    protected $fillable = [
        'image',
        'video',
    ];
}
