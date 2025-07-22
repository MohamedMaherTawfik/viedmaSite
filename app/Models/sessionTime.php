<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sessionTime extends Model
{
    protected $guarded = [];
    protected $table = 'session_times';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }
}
