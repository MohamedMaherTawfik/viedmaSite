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

        return redirect()->route('dashboard')->with('success', 'Registration successful! Please apply to become a teacher.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signin(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

}
