<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id', 'state', 'price',
        'delivery_name', 'delivery_address', 'delivery_city', 'delivery_zipCode', 'delivery_type', 'delivery_price'
    ];

    public function cart(){
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }

    public function getFullDeliveryLabel(){
        return $this->delivery_name . " " . $this->delivery_address . " " . $this->delivery_zipCode . " " . $this->delivery_city;
    }
}
