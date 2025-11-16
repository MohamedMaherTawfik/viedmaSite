<?php

namespace App\Http\Controllers\home;

use App\Models\Courses;
use App\Models\school;
use App\Models\User;

class schoolController
{
    public function schools()
    {
        $schools = school::with('admin')->get();
        return view('home.schools.index', compact('schools'));
    }

    public function showSchool(school $school)
    {
        $users = User::where('school_id', $school->id)->pluck('id')->toArray();
        $courses = Courses::whereIn('user_id', $users)->get();
        $categories = \App\Models\categories::get();
        return view('home.schools.show', compact('school', 'users', 'courses', 'categories'));
    }

    public function allSchools()
    {
        $schools = school::with('admin')->get();
        return view('home.schools.all', compact('schools'));
    }
}
