<?php

namespace App\Http\Controllers\api\parent;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\certificate;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\report;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;

class parentControllerApi extends Controller
{
    use ApiResponse;
    public function allParents()
    {
        $parents = User::where('role', 'parent')->get();
        return $this->success($parents, 'all parents');
    }

    public function children()
    {
        $children = User::find(request('id'));
        $children->load('student');
        return $this->success($children, 'all children');

    }

    public function reports()
    {
        $user = User::find(request('id'));
        $student = student::where('user_id', $user->id)->pluck('me_id')->toArray();
        $reports = report::where('student_id', $student)->get();
        return $this->success($reports, 'all reports');
    }

    public function certificates()
    {
        $user = User::find(request('id'));
        $student = student::where('user_id', $user->id)->pluck('me_id')->toArray();
        $certificates = certificate::where('user_id', $student)->get();
        return $this->success($certificates, 'all certificates for childrens');
    }

    public function courses()
    {
        $user = User::find(request('id'));
        $student = student::where('user_id', $user->id)->pluck('me_id')->toArray();
        $enrollments = Enrollments::where('user_id', $student)->pluck('courses_id')->toArray();
        dd($enrollments);
        $courses = Courses::whereIn('id', $enrollments)->get();
        return $this->success($courses, 'all courses for childrens');
    }

}