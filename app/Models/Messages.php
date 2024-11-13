<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'transporter_id', 'request_id', 'message', 'file', 'sender'];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function transporter()
    {
        return $this->belongsTo(Transporters::class);
    }
}
