<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTruck extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'weight',
        'quantity',
        'origin',
        'destination',
        'material',
        'schedule_date',
        'source_pin',
        'destination_pin',
        'pickup_type',
        'pickup_date',
        'customer_id',
        'bidding_ends_at',
        'distance',
        'time',
    ];
    protected $dates = ['bidding_ends_at'];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'bid_id');
    }

    public function winingbid()
    {
        return $this->belongsTo(Bid::class, 'winning_bid_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'request_truck_id');
    }

    // public function payment()
    // {
    //     return $this->hasOne(Payments::class);
    // }

    public function latestPayment()
    {
        return $this->hasOne(Payments::class)->latest('created_at');
    }

    public function truckRequests()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}
