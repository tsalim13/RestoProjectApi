<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAppInfo extends Model
{
    public $table = 'user_appinfo';

    public $fillable = [
        'user_id',
        'version',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'version' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

}
