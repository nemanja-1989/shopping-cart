<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

     public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Optional: if you want to get the order too
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
