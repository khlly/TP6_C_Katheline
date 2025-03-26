<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Payment extends Model
{

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'payment_date',
        'payment_method',
        'amount',
        'order_id',
        'customer_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
