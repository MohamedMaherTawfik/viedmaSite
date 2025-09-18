<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class coursesController extends Controller
{
    use ApiResponse;

    public function allCourses()
    {
        $courses = Courses::get();
        return $this->success($courses, 'All Courses');
    }

    public function myCourses()
    {
        $courses = Courses::where('user_id', auth()->user()->id)->get();
        return $this->success($courses, 'my Courses');
    }

    public function singleCourse()
    {
        $course = Courses::find(request('id'));
        return $this->success($course, 'single Course');
    }

    public function createCourse(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        try {
            if (isset($data['cover_photo'])) {
                $data['cover_photo'] = $data['cover_photo']->store('courses', 'public');
            }

            $course = Courses::create($data);
            return $this->success($course, 'Course Created Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }

    }

    public function deleteCourse()
    {
        Courses::find(request('id'))->delete();
        return $this->noContent();
    }
}