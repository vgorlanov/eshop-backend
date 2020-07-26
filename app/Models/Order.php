<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    protected $fillable = [
        'user_id', 'products', 'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setProductsAttribute($value): void
    {
        $this->attributes['products'] = json_encode($value);
    }

    public function getProductsAttribute($value)
    {
        return json_decode($value);
    }
}
