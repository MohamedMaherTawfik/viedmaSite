<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function courses()
    {
        $courses = Courses::get();
        return view('admin.courses.index', compact('courses'));
    }


    public function editCourse(Request $request, Courses $course)
    {
        $data = $request->except('_token');
        $course->update($data);
        return redirect()->back()->with('success', 'Course updated successfully');
    }
}
