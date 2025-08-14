<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\schoolRequest;
use App\Models\school;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function login()
    {
        return view('adminstrator.auth.login');
    }

    public function storeLogin(adminLoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth()->attempt($validated)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function dashboard()
    {
        return view('adminstrator.index');
    }

    public function schools()
    {
        return view('adminstrator.schools.index');
    }

    public function createSchool()
    {
        return view('adminstrator.schools.create');
    }

    public function storeSchool(schoolRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'admin';
        $school = school::create([
            'name' => $validated['school_name'],
            'type' => $validated['type'],
            'License_number' => $validated['License_number'],
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
        $school->load('users');
        return view('adminstrator.schools.show', compact('school'));
    }

    public function SchoolTeachers(school $school)
    {
        $school->load('users');
        return view('adminstrator.school.teachers.index', compact('school'));
    }

    public function trainers()
    {
        $users = User::where('role', 'trainer')->get();
        return view('adminstrator.trainers.index', compact('users'));
    }

    public function settings()
    {
        return view('adminstrator.settings.index');
    }

    public function updateUser(Request $request)
    {
        $fields = request()->all();
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $user = User::where('id', Auth::id())->update($fields);
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }


}
