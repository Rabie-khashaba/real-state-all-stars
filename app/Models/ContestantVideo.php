<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestantVideo extends Model
{
    use HasFactory;

    protected $fillable = ['contestant_id', 'type', 'file_path', 'youtube_url', 'stage_number', 'video_number','project_id'];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }
}