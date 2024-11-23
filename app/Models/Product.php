<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{

    protected $fillable = ['title', 'code', 'category', 'quantity', 'description', 'price', 'is_ordered', 'images', 'discount_price'];


    use HasFactory, Sluggable;

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function Sluggable():array
    {
        return
        [
            'slug' =>
            [
                'source' => 'title'
            ]
        ];
    }

    public function getFinalPriceAttribute()
    {
        return $this->discounted_price ?? $this->price;
    }
}


return redirect('/view_product');
