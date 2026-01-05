<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
use App\Http\Requests\parentRequest;
use App\Http\Requests\userEditRequest;
use App\Models\activity;
use App\Models\applyTeacher;
use App\Models\behaviour;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\Enrollments;
use App\Models\games;
use App\Models\gamesCategorey;
use App\Models\interaction;
use App\Models\orderdetails;
use App\Models\orders;
use App\Models\report;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $cart = cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            $cart = cart::create([
                'user_id' => Auth::id(),
            ]);
        }

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
                $cart = cart::where('user_id', Auth::id())->first();
                if (!$cart) {
                    $cart = cart::create([
                        'user_id' => Auth::id(),
                    ]);
                }
                return view('parentDashboard.index')->with('success', 'Logged in successfully!');
            }
            return view('welcome')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function dashboard()
    {
        $studentIds = student::where('user_id', Auth::id())->pluck('me_id');

        $activites = activity::whereIn('user_id', $studentIds)
            ->latest()
            ->take(3)
            ->get();

        $interactions = interaction::whereIn('user_id', $studentIds)
            ->latest()
            ->take(3)
            ->get();

        $behaviors = behaviour::whereIn('user_id', $studentIds)
            ->latest()
            ->take(3)
            ->get();

        return view(
            'parentDashboard.index',
            compact('activites', 'interactions', 'behaviors')
        );
    }



    public function children()
    {
        $students = student::where('user_id', Auth::id())->get();
        $studentsUser = student::where('user_id', Auth::id())->pluck('me_id');
        $enrollments = Enrollments::whereIn('user_id', $studentsUser)->get();
        return view('parentDashboard.student.index', compact('students', 'enrollments', 'studentsUser'));
    }

    public function games()
    {
        $games = games::all();
        return view('parentDashboard.games.index', compact('games', ));
    }

    public function reports()
    {
        $students = student::where('user_id', Auth::id())->pluck('id');
        $reports = report::whereIn('student_id', $students)->get();
        return view('parentDashboard.reports.index', compact('reports'));
    }

    public function settings()
    {
        return view('parentDashboard.settings.index');
    }

    public function storeSetting(userEditRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }
        User::find(Auth::id())->update($validated);
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function storeSettingPassword(Request $request)
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

    public function myorder(orders $order)
    {
        return view('parentDashboard.settings.order', compact('order'));
    }

}
