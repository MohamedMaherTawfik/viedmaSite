<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\school;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('public.login');
    }

    public function register()
    {
        $schools = school::all();
        return view('public.register', compact('schools'));
    }

    public function storelogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            $cart = cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                $cart = cart::create([
                    'user_id' => Auth::id(),
                ]);
            }
            if (Auth::user()->role == 'trainer') {
                return redirect()->route('trainerDashboard');
            }
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'school_id' => 'nullable',
            'nationallity' => 'nullable',
            'academic_stage' => 'nullable',
            'national_id' => 'nullable',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        student::create([
            'me_id' => $user->id,
            'name' => $request->name,
            'national_id' => $request->national_id,
            'nationallity' => $request->nationallity,
            'Academic_stage' => $request->academic_stage,
            'school_id' => $request->school_id,
            'slug' => Str::slug($request->name) . '-' . time(),
        ]);

        Auth::login($user);
        $cart = cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            $cart = cart::create([
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->route('home');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back()->with('success', 'Logout successfully!');
    }
}