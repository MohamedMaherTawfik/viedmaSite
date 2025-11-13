<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Enrollments;
use Illuminate\Http\Request;

class enrollmentController extends Controller
{
    use ApiResponse;

    public function allEnrollments()
    {
        $enrollments = Enrollments::where('courses_id', request('courseId'))->get();
        try {
            if (count($enrollments) == 0) {
                return $this->noContent();
            }
            return $this->success($enrollments, 'All Enrollments per course');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function enrollCourse()
    {
        $course = Courses::find(request('courseId'));
        $enrollment = Enrollments::create([
            'courses_id' => $course->id,
            'user_id' => auth()->id(),
            'price' => $course->price,
            'enrolled' => 'yes',
        ]);
        try {
            if (!$enrollment) {
                return $this->notFound('Enrollment not found');
            }
            return $this->success($enrollment, 'Successfully enrolled');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }
}