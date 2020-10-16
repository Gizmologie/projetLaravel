<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CartLine extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id', 'product_id', 'quantity'
    ];


    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
