<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public $table = 'product_option';

    public $fillable = [
        'product_id',
        'option_id',
        'option_price',
        'min_qte',
        'max_qte',
        'available',
        'required',
        'selected',
        'order'
    ];

    protected $casts = [
        'product_id' => 'string',
        'option_id' => 'string',
        'option_price' => 'double',
        'min_qte' => 'integer',
        'max_qte' => 'integer',
        'available' => 'boolean',
        'required' => 'boolean',
        'selected' => 'boolean',
        'order' => 'integer',
    ];

    public static $rules = [
        
    ];
}
