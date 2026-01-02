<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicStages extends Model
{
    protected $table = 'academic_stages';
    protected $guarded = [];

    public function student()
    {
        return $this->hasMany(student::class, 'academic_stages_id');
    }
}