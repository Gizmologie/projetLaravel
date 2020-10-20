<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Enum\OrderStateEnum;

class Order extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state', 'price', 'lines', 'user_id', 'hash',
        'delivery_name', 'delivery_address', 'delivery_city', 'delivery_zipCode', 'delivery_type', 'delivery_price'
    ];

    public static function createLines($objects){
        $lines = [];

        foreach ($objects as $object) {
            $lines[] = [
                'product' => [
                    'id' => $object->product->id,
                    'name' => $object->product->name,
                    'price' => $object->product->price,
                    'image' => $object->product->image,
                ],
                'quantity' => $object->quantity
            ]   ;
        }

        return json_encode($lines);
    }


    public function getNbObjects(){
        $total = 0;
        foreach ($this->getLines() as $line) {
            $total += $line['quantity'];
        }
        return $total;
    }

    public function getLines(){
        return json_decode($this->lines, true);
    }

    public function getTotal(){
        $total = 0;
        foreach ($this->getLines() as $line) {
            $total += $line['product']['price'] * $line['quantity'];
        }
        return $total;
    }

    public function getTotalWithDelivery(){
        return $this->getTotal() + $this->delivery_price;
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id')->first();
    }


    public function getFullDeliveryLabel(){
        return $this->delivery_name . " " . $this->delivery_address . " " . $this->delivery_zipCode . " " . $this->delivery_city;
    }

    public function getDeliveryStateName(){
        return OrderStateEnum::getName($this->state);
    }

    public function getDeliveryStateNumber(){
        switch ($this->state){
            case OrderStateEnum::$DELIVERY_SETUP:
                return 1;
            case OrderStateEnum::$BILLING_SETUP:
                return 2;
            case OrderStateEnum::$ACCEPTED:
                return 3;
            case OrderStateEnum::$DELIVERY_IN_PROCESS:
                return 4;
            case OrderStateEnum::$FINISHED:
                return 5;
            case OrderStateEnum::$CREATED:
            default:
                return 0;
        }
    }
}
