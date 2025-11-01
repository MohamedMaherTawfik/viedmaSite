<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Models\Courses;

class CoursesController extends Controller
{
    public function courses()
    {
        $courses = Courses::get();
        return view('admin.courses.index', compact('courses'));
    }
}
