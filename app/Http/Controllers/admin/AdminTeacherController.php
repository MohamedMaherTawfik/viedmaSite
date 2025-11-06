<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\applyTeacher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'trainer')->get();
        return view('admin.teachers.index', compact('students'));
    }


    public function create()
    {
        return view('admin.teachers.create');
    }


    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'trainer';
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
            'school_id' => $data['school_id'],
            'phone' => $data['phone'],
        ]);

        applyTeacher::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'status' => 'accepted',
            'topic' => $data['topic']
        ]);
        return redirect()->route('admin.teachers')->with('success', 'User created successfully.');
    }

    public function edit(User $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $data = $request->except('_token');
        $teacher->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'school_id' => $data['school_id'],
        ]);
        $apply = applyTeacher::where('user_id', $teacher->id)->first();
        $apply->phone = $data['phone'];
        $apply->topic = $data['topic'];
        $apply->save();
        return redirect()->route('admin.teachers')->with('success', 'teacher updated successfully.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with('success', 'teacher deleted successfully.');
    }
}