<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class honors extends Model
{
    protected $table = 'honors';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
