<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_ar',
        'header_en',
        'description_ar',
        'description_en',
        'before_mail_ar',
        'before_mail_en',
        'mail',
    ];

    protected $table = 'contact_contents';
}
