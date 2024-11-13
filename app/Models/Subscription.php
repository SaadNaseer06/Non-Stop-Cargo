<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory; 

    protected $fillable = [
        'transporter_id', 'plan_id', 'subscription_id',
        'status', 'start_date', 'end_date'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function transporter()
    {
        return $this->belongsTo(Transporters::class);
    }
}
