<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgeCon extends Model
{
    use HasFactory;

    protected $table = 'judge_cons';

    protected $fillable = [
        'name_ar',
        'name_en',
        'photo',
        'logo',
        'title_ar',
        'title_en',
        'bio_ar',
        'bio_en',
    ];

    // Return the localized name based on the current app locale
    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && !empty($this->name_ar)) {
            return $this->name_ar;
        }
        return $this->name_en ?? $this->name_ar;
    }

    // Return the localized title based on the current app locale
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && !empty($this->title_ar)) {
            return $this->title_ar;
        }
        return $this->title_en ?? $this->title_ar;
    }

    // Helpful accessor to build a full URL for the photo (falls back to a placeholder)
    public function getPhotoUrlAttribute()
    {
        $path = $this->photo ?: $this->logo;
        if (empty($path)) {
            return asset('storage/images/judge/judge.png');
        }
        return asset('storage/' . ltrim($path, '/'));
    }

    // Localized bio accessor
    public function getBioAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && !empty($this->bio_ar)) {
            return $this->bio_ar;
        }
        return $this->bio_en ?? $this->bio_ar;
    }
}

