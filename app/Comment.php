<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'rate', 'is_visible', 'user_id', 'product_id'];

    public function user ()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
