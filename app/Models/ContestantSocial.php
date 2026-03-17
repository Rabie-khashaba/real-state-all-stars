<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestantSocial extends Model
{
    use HasFactory;

    protected $fillable = ['contestant_id', 'platform', 'link'];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }
}
