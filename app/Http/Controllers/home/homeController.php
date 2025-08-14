<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\games;
use App\Models\orderdetails;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function index()
    {
        $games = games::all();
        return view('welcome', compact('games'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function profile()
    {
        $user = Auth::user();
        $orders = orders::where('user_id', $user->id)->get();
        return view('home.profile', compact('user', 'orders'));
    }

    public function showGame(games $game)
    {
        return view('home.singleGame', compact('game'));
    }

    public function allGames()
    {
        $games = games::all();
        return view('home.allGames', compact('games'));
    }

    public function addToCart(cartRequest $request, games $game)
    {
        $validatedData = $request->validated();

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
            'quantity' => $validatedData['quantity'],
        ]);
        return redirect()->back()->with('success', 'Game added to cart successfully!');
    }

    public function deleteFromCart()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        cartItems::where('cart_id', $cart->id)->where('games_id', request('id'))->delete();
        return redirect()->back()->with('success', 'Game removed from cart successfully!');
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
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    public function cart()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        $cartItems = cartItems::where('cart_id', $cart->id)->get();
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->games->price * $item->quantity;
        }
        $cartCount = count($cartItems);
        return view('home.cart', compact('cartItems', 'total', 'cartCount'));
    }
    public function updateProfile()
    {
        $user = Auth::user();
        $user->name = request('name');
        $user->email = request('email');
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
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
}
