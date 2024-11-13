<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayments extends Model
{
    use HasFactory;

    protected $fillable = [
        'transporter_id',
        'plan_id',
        'razorpay_order_id',
        'razorpay_payment_id',
        'payment_status',
        'amount'
    ];

    public function transporter()
    {
        return $this->belongsTo(Transporters::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
