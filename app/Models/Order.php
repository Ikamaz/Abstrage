<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }


}
