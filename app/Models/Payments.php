<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'transporter_id', 'request_truck_id', 'amount', 'payment_status', 'payment_method', 'transaction_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function transporter()
    {
        return $this->belongsTo(Transporters::class);
    }

    public function requestTruck()
    {
        return $this->belongsTo(RequestTruck::class, 'request_truck_id');
    }
}
