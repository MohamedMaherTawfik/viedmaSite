<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    protected $table = 'orderdetails';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(orders::class, 'orders_id');
    }

    public function game()
    {
        return $this->belongsTo(games::class, 'games_id');
    }

}
