<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCartOptions extends Model
{
    public $table = 'product_cart_options';

    public $fillable = [
        'option_id',
        'product_cart_id',
        'quantity',
        'option_attribute_id'
    ];

    protected $casts = [
        'option_id' => 'integer',
        'product_cart_id' => 'integer',
        'quantity' => 'integer',
        'option_attribute_id' => 'integer'
    ];

    public function optionAttribute()
    {
        return $this->belongsTo(\App\ProductOption::class, 'option_attribute_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(\App\Option::class, 'option_id', 'id');
    }

}
