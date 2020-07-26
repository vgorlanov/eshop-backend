<?php

namespace App\Models;

use App\Library\Cart\Cart;
use App\Library\Cart\CartStoreInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Services\ImageTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, ImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * user`s cart
     *
     * @return Cart
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function cart(): Cart
    {
        $store = app()->make(CartStoreInterface::class);

        return new Cart('cart_user_' . $this->id, $store);
    }

    /**
     * user`s orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * check admin role
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->roles()->where('roles.name', '=', 'admin')->first() ? true : false;
    }
}
