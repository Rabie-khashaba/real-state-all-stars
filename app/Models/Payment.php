<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'invoice_key',
        'package_id',
        'payment_method_id',
        'amount',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'votes_credited',
        'user_id',
        'contestant_id',
        'payment_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payment_data' => 'array',
        'votes_credited' => 'boolean',
    ];

    /**
     * Get the user that made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the contestant that the payment is for.
     */
    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }
}