<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class achievmentsUsers extends Model
{
    protected $table = 'achievments_users';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }

    public function school()
    {
        return $this->belongsTo(school::class);
    }
}
