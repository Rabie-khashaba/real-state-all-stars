<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_ar',
        'header_en',
        'description_ar',
        'description_en',
    ];

    protected $table = 'contact_supports';
}
