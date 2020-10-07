<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class  Product extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'functional_description',
        'technical_description',
        'price',
        'stock_quantity',
        'promotion',
        'image',
        'available_at',
    ];

}
