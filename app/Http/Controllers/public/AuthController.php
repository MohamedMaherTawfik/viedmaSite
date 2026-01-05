<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AcademicStages;
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
        $academicStages = AcademicStages::all();
        return view('public.register', compact('schools', 'academicStages'));
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
            } else if (Auth::user()->role == 'parent') {
                return redirect()->route('parent.dashboard');
            } else if (Auth::user()->role == 'user') {
                return redirect()->route('choose');
            } else if (Auth::user()->role == 'admin') {
                return redirect()->route('school.dashboard', ['slug' => Auth::user()->school->slug]);
            }
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'school_id' => 'nullable',
            'nationallity' => 'nullable',
            'academic_stage_id' => 'nullable',
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
            'academic_stages_id' => $request->academic_stage_id,
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

    public function forgotPassword()
    {
        return view('public.forgotPassword');
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->route('forgot.password.reset.form', ['email' => $request->email]);
        } else {
            return redirect()->back()->withErrors(['email' => 'Email not found!']);
        }
    }

    public function reset()
    {
        $data = request('email');
        return view('public.resetPassword', compact('data'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/')->with('success', 'Password reset successfully!');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email not found!']);
        }
    }
}