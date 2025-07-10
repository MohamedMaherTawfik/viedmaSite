<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    protected $guarded = [];

    protected $table = 'schools';

    public function user()
    {
        return $this->hasMany(User::class);
    }
}