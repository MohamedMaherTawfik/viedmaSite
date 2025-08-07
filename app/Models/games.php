<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class games extends Model
{
    protected $guarded = [];
    protected $table = 'games';
    public function gameCategorey()
    {
        return $this->belongsTo(gamesCategorey::class, 'games_categorey_id');
    }

    public function cart()
    {
        return $this->belongsToMany(cart::class, 'cart_items');
    }

    public function orderdetails()
    {
        return $this->hasMany(orderdetails::class, 'games_id');
    }

}
