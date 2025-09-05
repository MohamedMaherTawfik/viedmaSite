<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\schoolRequest;
use App\Models\school;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SchoolsController extends Controller
{
    use ApiResponse;
    public function allSchools()
    {
        $schools = school::paginate(5);
        if (!$schools) {
            return $this->noContent();
        }
        return $this->success($schools);
    }

    public function singleSchool()
    {
        $school = school::find(request('id'));
        $users = User::where('school_id', $school->id)->get();
        if (!$school) {
            return $this->notFound('School not found');
        }
        return $this->success(['school' => $school, 'users' => $users]);
    }

    public function createSchool(schoolRequest $request)
    {
        $data = $request->validated();
        $school = school::create([
            'name' => $data['school_name'],
            'type' => $data['type'],
            'license_number' => $data['license_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'slug' => Str::slug($data['school_name']) . '-' . time(),
        ]);

        $user = User::create([
            'school_id' => $school->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role' => 'admin',
        ]);

        return $this->success($user->load('school'));
    }

    public function updateSchool(Request $request)
    {
        $data = $request->all();
        $school = school::find(request('id'));
        if (!$school) {
            return $this->notFound();
        }
        $school->update([
            'name' => $data['school_name'],
            'type' => $data['type'],
            'License_number' => $data['license_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'slug' => Str::slug($data['school_name']) . '-' . time(),
        ]);

        $user = User::where('school_id', $school->id)->first();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
        return $this->success($user->load('school'));

    }

    public function deleteSchool()
    {
        $school = school::find(request('id'));
        if (!$school) {
            return $this->notFound();
        }
        $school->delete();
        return $this->noContent();
    }
}
