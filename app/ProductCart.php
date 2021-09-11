<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    public $table = 'product_carts';

    public $fillable = [
        'product_id',
        'user_id',
        'quantity'
    ];

    protected $casts = [
        'product_id' => 'integer',
        'user_id' => 'integer',
        'quantity' => 'integer'
    ];

    public static $rules = [
        'product_id' => 'required|exists:products,id',
        'user_id' => 'required|exists:users,id'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    public function options()
    {
        return $this->belongsToMany(\App\Option::class, 'product_cart_options', 'product_cart_id', 'option_id')->withPivot('quantity')->as('quantity');
    }
}
