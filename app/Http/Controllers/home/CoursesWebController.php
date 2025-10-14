<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\graduationProject;
use Illuminate\Support\Facades\Storage;

class CoursesWebController extends Controller
{
    public function courses()
    {
        $courses = Courses::get();
        $categories = \App\Models\categories::get();
        return view('web.courses.index', compact('courses', 'categories'));
    }

    public function show()
    {
        $course = Courses::where('slug', request('slug'))->first();
        return view('web.courses.show', compact('course'));
    }

    public function enrolledCourses()
    {
        $enrollments = Enrollments::where('user_id', auth()->id())->where('enrolled', 'yes')->pluck('courses_id');
        $courses = Courses::whereIn('id', $enrollments)->get();

        return view('web.courses.enrolled', compact('courses'));
    }

    public function enrolledCourse(Courses $course)
    {
        // $zoommeeting = ZoomMeeting::where('courses_id', $course->id)
        //     ->orderBy('id', 'desc')
        //     ->first();
        $projects = graduationProject::where('courses_id', $course->id)->get();
        $relatedCourses = Courses::where('categorey_id', $course->categorey_id)->take(3)->get();
        return view('web.courses.enrolledCourse', compact('course', 'relatedCourses', 'projects'));
    }

    public function privacy()
    {
        return view('web.conditions.privacy');
    }

    public function terms()
    {
        return view('web.conditions.terms');
    }

}
