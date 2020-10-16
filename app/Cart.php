<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    public function lines(){
        return $this->hasMany(CartLine::class);
    }

    public function getNbObjects(){
        $total = 0;
        foreach ($this->lines()->get() as $line) {
            $total += $line->quantity;
        }
        return $total;
    }

    public function getTotal(){
        $total = 0;
        foreach ($this->lines()->get() as $line) {
            $total += $line->quantity * $line->product->price;
        }
        return $total;
    }
}
