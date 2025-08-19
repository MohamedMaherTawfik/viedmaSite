<?php

namespace App\Http\Controllers\home;

use App\Models\school;
use Illuminate\Http\Request;

class schoolController
{
    public function schools()
    {
        $schools = school::with('admin')->get();
        return view('home.schools.index', compact('schools'));
    }

    public function showSchool(school $school)
    {
        return view('home.schools.show', compact('school'));
    }

    public function allSchools()
    {
        $schools = school::with('admin')->get();
        return view('home.schools.all', compact('schools'));
    }
}