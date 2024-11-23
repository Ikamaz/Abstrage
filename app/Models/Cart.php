<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // A cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A cart belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
