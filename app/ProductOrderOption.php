<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrderOption extends Model
{
    public $table = 'product_order_options';

    public $fillable = [
        'option_id',
        'product_order_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'option_id' => 'integer',
        'product_order_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'integer'
    ];

    public function option()
    {
        return $this->belongsTo(\App\Option::class, 'option_id', 'id');
    }
}
