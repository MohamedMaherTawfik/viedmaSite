<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gamesCategorey extends Model
{
    protected $guarded = [];
    protected $table = 'games_categoreys';
    public function games()
    {
        return $this->hasMany(games::class);
    }
}