<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $table = 'tables';

    public $fillable = [
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

}
