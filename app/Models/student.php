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

    public function me()
    {
        return $this->belongsTo(User::class, 'me_id');
    }

    public function school()
    {
        return $this->belongsTo(school::class);
    }

    public function reports()
    {
        return $this->hasMany(report::class);
    }

    public function academicStage()
    {
        return $this->belongsTo(AcademicStages::class, 'academic_stages_id');
    }
}
