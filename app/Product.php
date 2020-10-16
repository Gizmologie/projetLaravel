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
        'base_price',
        'stock_quantity',
        'promotion',
        'image',
        'available_at',
    ];

    public function getImage(){
        return '/' . $this->image;
    }

    public function getCategory(){
        return $this->hasOne(Category::class, 'id', 'category_id')->first();
    }

}
