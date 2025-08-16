<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    protected $guarded = [];

    protected $table = 'schools';

    public function user()
    {
        return $this->hasMany(User::class, 'school_id');
    }

    public function students()
    {
        return $this->hasMany(student::class);
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'school_id')->where('role', 'admin');
    }
}
