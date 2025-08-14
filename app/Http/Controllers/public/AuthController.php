<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('public.login');
    }

    public function register()
    {
        return view('public.register');
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
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
        return redirect()->route('home');
    }
}