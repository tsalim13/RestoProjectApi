<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public $table = 'zone';

    public $fillable = [
        'label',
        'base_price',
        'unit_price',
        'min_distance',
        'max_distance',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'string',
        'base_price' => 'integer',
        'unit_price' => 'integer',
        'min_distance' => 'integer',
        'max_distance' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'unit_price' => 'required',
        'min_distance' => 'required',
        'max_distance' => 'required',
    ];

}
