<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'carts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function games()
    {
        return $this->belongsToMany(games::class, 'cart_items');
    }

    public function cartItems()
    {
        return $this->hasMany(cartItems::class, 'cart_id');
    }

    public function total()
    {
        return $this->games()->sum('price');
    }
}