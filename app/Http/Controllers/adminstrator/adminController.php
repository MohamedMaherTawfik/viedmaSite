<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\GameRequest;
use App\Http\Requests\schoolRequest;
use App\Http\Requests\schoolUpdateRequest;
use App\Http\Requests\userUpdateRequest;
use App\Models\cart;
use App\Models\games;
use App\Models\school;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function login()
    {
        return view('admin.auth.login', );
    }

    public function storeLogin(adminLoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth()->attempt($validated)) {
            $cart = cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                $cart = cart::create([
                    'user_id' => Auth::id(),
                ]);
            }
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function dashboard()
    {

        $schoolsCount = school::count();
        $parentsCount = User::where('role', 'parent')->count();
        $teachersCount = User::where('role', 'teacher')->count();
        $trainersCount = User::where('role', 'trainer')->count();
        $studentsCount = student::count();

        return view('admin.index', compact('schoolsCount', 'parentsCount', 'teachersCount', 'trainersCount', 'studentsCount'));
    }

    public function games()
    {
        $games = games::all();
        return view('admin.games.index', compact('games'));
    }

    public function createGame()
    {
        return view('admin.games.create');
    }

    public function storeGame(GameRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('photos', 'public');
        }
        games::create($validated);
        return redirect()->route('admin.games.index')->with('success', 'Game created successfully');

    }

    public function showGame(games $game)
    {
        return view('admin.games.show', compact('game'));
    }

    public function deleteGame(games $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully');
    }

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

    public function settings()
    {
        return view('admin.settings.index');
    }

    public function updateUser(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
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
