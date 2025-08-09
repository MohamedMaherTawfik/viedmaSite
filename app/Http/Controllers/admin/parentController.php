<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\parentRequest;
use App\Http\Requests\userEditRequest;
use App\Models\applyTeacher;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\games;
use App\Models\gamesCategorey;
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

    public function children()
    {
        $students = student::where('user_id', Auth::id())->get();
        return view('parentDashboard.student.index', compact('students'));
    }

    public function games()
    {
        $games = games::all();
        $gameCategorey = gamesCategorey::all();
        return view('parentDashboard.games.index', compact('games', 'gameCategorey'));
    }

    public function addToCart(games $game)
    {
        $cart = cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            $cart = cart::create([
                'user_id' => Auth::id(),
            ]);
        }
        if (cartItems::where('cart_id', $cart->id)->where('games_id', $game->id)->exists()) {
            return redirect()->back()->with('error', 'Game already added to cart!');
        }
        cartItems::create([
            'cart_id' => $cart->id,
            'games_id' => $game->id,
            'quantity' => request('quantity'),
        ]);
        return redirect()->back()->with('success', 'Game added to cart successfully!');
    }

    public function deleteFromCart(games $game)
    {
        $cart = cart::where('user_id', Auth::id())->first();
        cartItems::where('cart_id', $cart->id)->where('games_id', $game->id)->delete();
        return redirect()->back()->with('success', 'Game removed from cart successfully!');
    }


    public function parentCart()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        $cartItems = cartItems::where('cart_id', $cart->id)->get();
        return view('parentDashboard.games.cart', compact('cartItems'));
    }
    public function checkout()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        $cartItems = cartItems::where('cart_id', $cart->id)->get();
        $quantity = 0;
        $price = 0;
        foreach ($cartItems as $item) {
            $quantity += $item->quantity;
            $price += $item->games->price * $item->quantity;
        }
        $order = orders::create([
            'user_id' => Auth::id(),
            'quantity' => $quantity,
            'price' => $price
        ]);

        foreach ($cartItems as $item) {
            orderdetails::create([
                'orders_id' => $order->id,
                'games_id' => $item->games_id,
                'quantity' => $item->quantity,
                'price' => $item->games->price
            ]);
        }
        foreach ($cartItems as $item) {
            $item->delete();
        }
        $cart->delete();
        return redirect()->route('parent.games')->with('success', 'Order placed successfully!');
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