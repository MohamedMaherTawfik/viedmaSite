<?php

namespace App\Http\Controllers\api\parent;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\certificate;
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
        $children->load('studentMe', 'student');
        dd($children);
        return $this->success($children, 'all children');
    }

    public function linkChild()
    {
        $student = student::find(request('id'));
        if (!$student) {
            return $this->notFound('student not found');
        }
        $student->user_id = request('user_id');
        $student->save();
        return $this->success($student, 'student linked to parent successfully');
    }


    public function reports()
    {
        $user = User::find(request('id'));
        $student = student::where('user_id', $user->id)->pluck('id')->toArray();
        $reports = report::where('student_id', $student)->get();
        return $this->success($reports, 'all reports');
    }

    public function certificates()
    {
        $user = User::find(request('id'));
        $student = student::where('user_id', $user->id)->pluck('id')->toArray();
        $certificates = certificate::where('user_id', $student)->get();
        return $this->success($certificates, 'all certificates for childrens');
    }


}
