<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'api_token',
        'device_token',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|phone|max:255|unique:users',
        'password' => 'required',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'password' => 'string',
        //'api_token' => 'string',
        'device_token' => 'string',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    public function carts() {
        return $this->hasMany(\App\ProductCart::class);
    }

    public function orders() {
        return $this->hasMany(\App\Order::class);
    }

    public function roles()
    {
        return $this->belongsToMany(App\Role::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
