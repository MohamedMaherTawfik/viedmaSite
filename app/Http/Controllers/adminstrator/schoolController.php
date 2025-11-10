<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\schoolRequest;
use App\Http\Requests\schoolUpdateRequest;
use App\Http\Requests\userUpdateRequest;
use App\Models\school;
use App\Models\User;
use Illuminate\Support\Str;

class schoolController extends Controller
{
    public function schools()
    {
        $schools = school::with('admin')->get();
        return view('admin.schools.index', compact('schools'));
    }

    public function createSchool()
    {
        return view('admin.schools.create');
    }

    public function storeSchool(schoolRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'admin';
        $school = school::create([
            'name' => $validated['school_name'],
            'type' => $validated['type'],
            'License_number' => $validated['license_number'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'slug' => Str::slug($validated['school_name']) . '-' . time(),
        ]);
        User::create([
            'name' => $validated['name'] . '-' . time(),
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
            'school_id' => $school->id,
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'School created successfully');
    }

    public function showSchool(school $school)
    {
        $school->load('user');
        $users = User::where('school_id', $school->id)->get();
        dd($users);
        return view('admin.schools.show', compact('school'));
    }

    public function editSchool(school $school)
    {
        $school->load('admin');
        return view('admin.schools.edit', compact('school'));
    }

    public function updateSchool(schoolUpdateRequest $request, school $school)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        $school->update($validated);
        return redirect()->route('admin.schools.index')->with('success', 'School updated successfully');
    }

    public function deleteSchool(school $school)
    {
        $school->delete();
        return redirect()->route('admin.schools.index')->with('success', 'School deleted successfully');
    }

    public function SchoolTeachers(school $school)
    {
        $school->load('user');
        return view('admin.teachers.index', compact('school'));
    }

    public function trainers()
    {
        $users = User::where('role', 'trainer')->get();
        return view('admin.trainers.index', compact('users'));
    }

    public function editUser(school $school, User $user)
    {
        return view('admin.user.edit', compact('user', 'school'));
    }

    public function updateSchoolUser(userUpdateRequest $request, school $school, User $user)
    {
        $validated = $request->validated();
        $user->update($validated);
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function deleteUser(school $school, User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
