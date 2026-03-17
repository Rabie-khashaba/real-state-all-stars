<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'professional_title',
        'email',
        'phone',
        'company',
        'areas_of_expertise',
        'experience_description',
        'document_path',
    ];

    protected $casts = [
        'areas_of_expertise' => 'array',
    ];
}
