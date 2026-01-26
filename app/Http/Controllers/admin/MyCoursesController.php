<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\assignment_submission;
use App\Models\categories;
use App\Models\Courses;
use App\Models\graduationProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyCoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::where('user_id', Auth::user()->id)->get();
        return view('admin.Mycourses.index', compact('courses'));
    }

    public function show(Courses $course)
    {
        $ids = graduationProject::where('teacher_id', Auth::user()->id)->pluck('id');
        $uploads = assignment_submission::whereIn('graduation_project_id', $ids)->get();
        return view('admin.Mycourses.show', compact('course', 'uploads'));
    }

    public function create()
    {
        $categories = categories::all();
        return view('admin.Mycourses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('cover_photos', 'public');
        }
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        Courses::create($data);
        return redirect()->route('admin.courses.me')->with('success', 'Course created successfully');
    }

    public function edit(Request $request, Courses $course)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('cover_photos', 'public');
        }
        $course->update($data);
        return redirect()->back()->with('success', 'Course updated successfully');
    }

    public function delete(Courses $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully');
    }

}