<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Order extends Model
{

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'order_date',
        'total_price',
        'customer_id',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    protected function orderDate(): Attribute
    {
        return Attribute::make(
            // Mutator: Convert input format to Mysql format before saving
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s'),

            // Accessor: Convert database format to user format when retrieving
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')
        );
    }   
}
