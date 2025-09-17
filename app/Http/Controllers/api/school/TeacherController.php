<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    use ApiResponse;

    public function allUsers()
    {
        $users = User::where('role', 'student')->where('school_id', auth()->user()->school_id)->get();

        return $this->success($users, 'all users');
    }

    public function getUser()
    {
        $user = User::where('id', request('id'))->first();
        return $this->success($user, 'user fetched successfully');
    }

    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'password' => 'required|confirmed',
            'national_id' => 'nullable',
            'nationallity' => 'nullable',
            'Academic_stage' => 'nullable',
        ]);
        $data['school_id'] = auth()->user()->school_id;
        $user = User::create([
            'name' => $data['name'] ?? "",
            'email' => $data['email'] ?? "",
            'phone' => $data['phone'] ?? "",
            'password' => bcrypt($data['password'] ?? ""),
            'role' => 'student',
            'school_id' => auth()->user()->school_id
        ]);
        $student = student::create([
            'user_id' => $user->id,
            'name' => $data['name'] ?? "",
            'national_id' => $data['national_id'] ?? "",
            'nationallity' => $data['nationallity'] ?? "",
            'Academic_stage' => $data['Academic_stage'] ?? "",
            'school_id' => $user->school_id,
            'slug' => Str::slug($data['name']) . '-' . time(),
        ]);
        return $this->success(['user' => $user, 'student' => $student], 'user created successfully');
    }

    public function deleteUser()
    {
        $user = User::find(request('id'));
        if (!$user) {
            return $this->notFound();
        }
        $user->delete();
        return $this->noContent();
    }
}