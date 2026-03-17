<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'entity_country',
        'contact_person',
        'phone',
        'email',
        'entity_website',
        'type_of_partnership',
        'other_sector',
        'interest_description',
        'document_path',
        'agree',
    ];

    protected $casts = [
        'type_of_partnership' => 'array',
        'agree' => 'boolean',
    ];
}
