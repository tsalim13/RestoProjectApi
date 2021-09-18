<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAdresses extends Model
{
    public $table = 'delivery_addresses';

    public $fillable = [
        'description',
        'address',
        'latitude',
        'longitude',
        'is_default',
        'user_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'string',
        'address' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'is_default' => 'boolean',
        'user_id' => 'integer',
        'type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        'address' => 'required',
        'user_id' => 'required|exists:users,id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
