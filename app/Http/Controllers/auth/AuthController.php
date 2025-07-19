<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\teacherRequest;
use App\Models\applyTeacher;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function signUp()
    {
        return view('auth.register');
    }
    public function register(userRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'teacher';
        $user = User::create($validatedData);
        Auth::login($user);

        return redirect()->route('teacher')->with('success', 'Registration successful! Please apply to become a teacher.');
    }

    public function teacherRegister()
    {
        return view('auth.teacherLogin');
    }

    public function teacher(teacherRequest $request)
    {
        $validatedData = $request->validated();
        applyTeacher::create([
            'user_id' => Auth::id(),
            'topic' => $validatedData['topics'],
            'phone' => $validatedData['phone'],
            'status' => 'pending',
        ]);
        return view('auth.teacherApplied');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function signin(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'teacher') {
                request()->session()->regenerate();
                return redirect()->route('dashboard');
            }
            request()->session()->regenerate();
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }



    // public function resetPage()
    // {

    // }

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = Auth::user();

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return back()->withErrors(['current_password' => 'Current password is incorrect']);
    //     }

    //     $user->update([
    //         'password' => Hash::make($request->password)
    //     ]);

    //     return back()->with('success', 'Password updated successfully!');
    // }
}
