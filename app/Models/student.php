<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $guarded = [];
    protected $table = 'students';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(school::class);
    }

    public function reports()
    {
        return $this->hasMany(report::class);
    }
}
