<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',     // Allows mass assignment of the user_id field
        'product_id',  // Allows mass assignment of the product_id field
        // Add any other fields that should be mass assignable
    ];

    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }

    public function product()
    {
        return $this->hasOne(Product::class,"id","product_id");
    }
}
