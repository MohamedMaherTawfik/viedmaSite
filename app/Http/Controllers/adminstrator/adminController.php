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


}
