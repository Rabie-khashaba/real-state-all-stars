<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','nationality_id','profile_photo_path', 'dob', 'gender', 'phone',
        'experience', 'employer', 'expertise_areas', 'expertise_other', 'destinations',
        'status', 'activation_way', 'code', 'is_verified', 'verified_at', 'expire_at',
        'participation_reason','standout_reason'
    ];

    protected $casts = [
        'expertise_areas' => 'array',
        'destinations' => 'array',
        'dob' => 'date',
        'verified_at' => 'datetime',
        'expire_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videos()
    {
        return $this->hasMany(ContestantVideo::class);
    }

    public function socials()
    {
        return $this->hasMany(ContestantSocial::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'N/A';
    }

    public function contestantStageReview()
    {
        return $this->hasOne(ContestantStageReview::class);
    }

    public function contestantStageReviews()
    {
        return $this->hasMany(ContestantStageReview::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    
    
    
    
    
    
    
}