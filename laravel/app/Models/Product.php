<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'pricing', 'description','category_id'];

    public function products(){
     
         return $this->hasMany(Product::class);
    }
}
