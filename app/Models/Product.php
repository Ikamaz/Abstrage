<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = ['title', 'code', 'category', 'quantity', 'description', 'price', 'is_ordered', 'images'];


    use HasFactory, SoftDeletes;

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}



return redirect('/view_product');
