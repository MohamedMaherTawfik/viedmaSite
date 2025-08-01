<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class graduationNotes extends Model
{
    protected $guarded = [];
    protected $table = 'graduation_notes';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment_submission()
    {
        return $this->belongsTo(assignment_submission::class, 'graduation_project_id');
    }

    public function teacherUpload()
    {
        return $this->belongsTo(User::class, 'uploaded_teacher_id');
    }

    public function project()
    {
        return $this->belongsTo(graduationProject::class, 'graduation_project_id');
    }
}
