<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\parentRequest;
use App\Models\applyTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class parentController extends Controller
{
    public function registerParent()
    {
        return view('parentDashboard.auth.register');
    }

    public function parentRegister(parentRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'parent',
            'phone' => $validatedData['phone'],
            'school_id' => $validatedData['school_id'],
        ]);
        applyTeacher::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        Auth::login($user);
        return view('parentDashboard.auth.parentApllied')->with('success', 'Parent registered successfully!');
    }

    public function loginParent()
    {
        return view('parentDashboard.auth.login');
    }


    public function parentLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $parent = Auth::user();
            if ($parent->role == 'parent' && $parent->applyTeacher->status == 'accepted') {
                return view('parentDashboard.index')->with('success', 'Logged in successfully!');
            }
            return view('welcome')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }


    public function dashboard()
    {
        return view('parentDashboard.index');
    }
}