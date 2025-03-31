<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use SoftDeletes;

class Category extends Model
{    use HasFactory; 
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
