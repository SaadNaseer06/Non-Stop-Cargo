<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporters extends Model
{
    use HasFactory;

    protected $fillable = ['phone_otp', 'phone_otp_expires_at'];
    protected $casts = [
        'phone_otp_expires_at' => 'datetime',
    ];

    public function isValid()
    {
        return $this->phone_otp_expires_at && $this->phone_otp_expires_at->isFuture();
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'transporter_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'transporter_id');
    }

}
