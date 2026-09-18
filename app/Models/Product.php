<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock'
    ];


    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}