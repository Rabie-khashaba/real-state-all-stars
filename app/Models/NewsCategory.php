<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'slug'];
    protected $table = 'news_categories';

    public function news()
    {
        return $this->hasMany(News::class,'category_id');
    }
}