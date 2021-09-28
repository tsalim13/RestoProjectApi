<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';
    
    public $fillable = [
        'user_id',
        'order_status_id',
        'price',
        'delivery_fee',
        'hint',
        'comment',
        'active',
        'paid',
        'driver_id',
        'delivery_address_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'order_status_id' => 'integer',
        'price' => 'integer',
        'delivery_fee' => 'integer',
        'hint' => 'string',
        'comment' => 'string',
        'active' =>'boolean',
        'paid' =>'boolean',
        'driver_id' => 'integer',
        'delivery_address_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'order_status_id' => 'required|exists:order_statuses,id',
        'driver_id' => 'nullable|exists:users,id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function driver()
    {
        return $this->belongsTo(\App\User::class, 'driver_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orderStatus()
    {
        return $this->belongsTo(\App\OrderStatus::class, 'order_status_id', 'id');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(\App\DeliveryAdresses::class, 'delivery_address_id', 'id');
    }

    public function productOrders()
    {
        return $this->hasMany(\App\ProductOrder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function products()
    {
        return $this->belongsToMany(\App\Product::class, 'product_orders');
    }

}
