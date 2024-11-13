<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public function requestTruck()
    {
        return $this->belongsTo(RequestTruck::class, 'bid_id')->with('customer');
    }

    public function transporter()
    {
        return $this->belongsTo(Transporters::class, 'transporter_id');
    }

    public function winingbid()
    {
        return $this->hasOne(RequestTruck::class, 'winning_bid_id')->with('transporter');
    }
}
