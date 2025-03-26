<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Wishlist extends Model
{

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id',
        'customer_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
