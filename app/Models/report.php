<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $guarded = [];

    protected $table = 'reports';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }
}
