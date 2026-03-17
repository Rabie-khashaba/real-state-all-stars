<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'promo_code' , 'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function contestant()
    {
        return $this->hasOne(Contestant::class);
    }
    
    
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
    
    // تحقق إذا المستخدم مهتم بمتسابق محدد
    public function hasInterested($contestantId)
    {
        return $this->interests()->where('contestant_id', $contestantId)->exists();
    }
    
    
}
