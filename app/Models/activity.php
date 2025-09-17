<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    protected $table = 'activities';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
