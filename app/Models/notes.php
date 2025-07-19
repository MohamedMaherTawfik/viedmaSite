<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    protected $guarded = [];
    protected $table = 'notes';
    public function assignmentSubmission()
    {
        return $this->belongsTo(assignment_submission::class);
    }
}