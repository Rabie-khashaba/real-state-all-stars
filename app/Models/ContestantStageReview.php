<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestantStageReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'contestant_id',
        'stage_number',
        'status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
        'is_winner',
        'winnered_by',
        'winnered_at',
    ];

    protected $casts = [
        'is_winner' => 'boolean',
        'reviewed_at' => 'datetime',
        'winnered_at' => 'datetime',
    ];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }

}