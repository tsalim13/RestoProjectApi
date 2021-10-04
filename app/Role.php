<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'role';

    public $fillable = [
        'label'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'label' => 'required'
    ];
}
