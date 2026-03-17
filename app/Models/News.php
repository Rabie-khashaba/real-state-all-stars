<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewsCategory;
class News extends Model
{
    use HasFactory;
    protected $fillable = ['title_ar', 'title_en', 'image_path', 'category_id', 'date', 'content_ar', 'content_en', 'news_header_img'];

    protected $table = 'news';

    public function category()
    {
        return $this->belongsTo(NewsCategory::class,'category_id');
    }
}



