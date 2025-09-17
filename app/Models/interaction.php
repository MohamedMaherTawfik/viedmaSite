<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class interaction extends Model
{
    protected $table = 'interactions';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
