<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class behaviour extends Model
{
    protected $table = 'behaviours';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
