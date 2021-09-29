<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    public $table = 'product_orders';

    public $fillable = [
        'quantity',
        'product_id',
        'order_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'product_id' => 'integer',
        'order_id' => 'integer'
    ];

    public static $rules = [
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id', 'id');
    }

    public function options()
    {
        return $this->belongsToMany(\App\Option::class, 'product_order_options', 'product_order_id', 'option_id')
                    ->withPivot('price', 'quantity')
                    ->as('product_order_options');
    }

    public function order()
    {
        return $this->belongsTo(\App\Order::class, 'order_id', 'id');
    }
}
