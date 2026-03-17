<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['contestant_id', 'user_id', 'voted_at'];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
