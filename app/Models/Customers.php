<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
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

    public function requestinfo()
    {
        return $this->hasOne(RequestTruck::class, 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    // public function payment()
    // {
    //     return $this->hasOne(Payments::class, 'customer_id');
    // }

    public function truckRequests()
    {
        return $this->hasMany(RequestTruck::class, 'customer_id');
    }
}
