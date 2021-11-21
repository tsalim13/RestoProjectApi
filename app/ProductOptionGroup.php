<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptionGroup extends Model
{
    public $table = 'product_option_groups';

    public $fillable = [
        'product_id',
        'option_group_id',
        'min_select',
        'max_select',
        'order'
    ];

    protected $casts = [
        'product_id' => 'string',
        'option_group_id' => 'string',
        'min_select' => 'integer',
        'max_select' => 'integer',
        'order' => 'integer',
    ];

    public static $rules = [
        
    ];
}
