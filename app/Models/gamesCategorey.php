<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gamesCategorey extends Model
{
    protected $table = 'game_categoreys';
    protected $guarded = [];
    public function games()
    {
        return $this->hasMany(games::class);
    }
}
