<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    protected $table = 'certificates';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'courses_id');
    }
}
