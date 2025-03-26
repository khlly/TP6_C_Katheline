<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SoftDeletes;

class Product extends Model
{
    //
    use HasFactory;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'images'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
