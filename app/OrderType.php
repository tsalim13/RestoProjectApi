<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    public $table = 'order_types';

    public $fillable = [
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required'
    ];

    public function orderStatus()
    {
        return $this->belongsToMany(\App\OrderStatus::class, 'order_type_order_status', 'order_types_id', 'order_status_id');
    }
    
}
