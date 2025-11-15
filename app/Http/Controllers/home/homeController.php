<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\Courses;
use App\Models\games;
use App\Models\gamesCategorey;
use App\Models\orders;
use App\Models\school;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function separate()
    {
        $users = User::count();
        $courses = Courses::count();
        $schools = school::count();
        return view('home.separate', compact('users', 'courses', 'schools'));
    }

    public function index()
    {
        $gameCategorey = gamesCategorey::all();
        $games = games::all();
        return view('welcome', compact('games', 'gameCategorey'));
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
        return view('home.store.singleGame', compact('game'));
    }

    public function allGames()
    {
        $games = games::all();
        $categories = gamesCategorey::all();
        return view('home.store.allGames', compact('games', 'categories'));
    }

    public function addToCart(cartRequest $request, games $game)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', __('messages.login_to_add_cart'));
        }

        $validatedData = $request->validated();

        $cart = cart::firstOrCreate(['user_id' => Auth::id()]);

        if (cartItems::where('cart_id', $cart->id)->where('games_id', $game->id)->exists()) {
            return redirect()->back()->with('error', __('messages.game_already_in_cart'));
        }

        cartItems::create([
            'cart_id' => $cart->id,
            'games_id' => $game->id,
            'quantity' => $validatedData['quantity'],
        ]);

        return redirect()->back()->with('success', __('messages.game_added_cart'));
    }

    public function deleteFromCart(Request $request)
    {
        $cart = cart::where('user_id', Auth::id())->first();
        $cartItem = cartItems::where('cart_id', $cart->id)
            ->where('games_id', $request->id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', __('messages.game_removed_cart'));
        }

        return redirect()->back()->with('error', __('messages.cart_item_not_found'));
    }

    public function checkout()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            return redirect()->back()->with('error', __('messages.cart_empty'));
        }

        $cartItems = cartItems::where('cart_id', $cart->id)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', __('messages.cart_empty'));
        }

        return redirect()->route('pay.form.store', $cart)
            ->with('success', __('messages.order_placed'));
    }

    public function cart()
    {
        $cart = cart::where('user_id', Auth::id())->first();
        $cartItems = $cart ? cartItems::where('cart_id', $cart->id)->get() : collect();
        $total = $cartItems->sum(fn($item) => $item->games->price * $item->quantity);
        $cartCount = $cartItems->count();

        return view('home.store.cart', compact('cartItems', 'total', 'cartCount'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', __('messages.profile_updated'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => __('messages.current_password_wrong')]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', __('messages.password_changed'));
    }

    public function showCategorey(gamesCategorey $categorey)
    {
        $categorey->load('games.categorey');
        $games = $categorey->games;
        return view('home.store.categorey', compact('categorey', 'games'));
    }

    public function updateCart(Request $request)
    {
        $cartItem = cartItems::find($request->cartItem);

        if (!$cartItem) {
            return redirect()->back()->with('error', __('messages.cart_item_not_found'));
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', __('messages.cart_updated'));
    }
}