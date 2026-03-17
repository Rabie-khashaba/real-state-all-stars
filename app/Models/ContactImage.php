<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
    ];

    protected $table = 'contact_images';

}
