<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\assignment_submission;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\graduationProject;
use App\Models\lesson;

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

    public function showLesson(lesson $course)
    {
        return view('web.lesson.show', compact('course'));
    }

    public function uploadProject(\Illuminate\Http\Request $request, graduationProject $course)
    {
        $data = $request->except('_token');
        if ($request->hasFile('project_file')) {
            $data['project_file'] = $request->file('project_file')->store('Projects', 'public');
        }
        assignment_submission::create([
            'user_id' => auth()->id(),
            'file' => $data['project_file'],
            'graduation_project_id' => $course->id,
        ]);
        return redirect()->back()->with('success', 'Project uploaded successfully.');
    }
}
