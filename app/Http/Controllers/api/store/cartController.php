<?php

namespace App\Http\Controllers\api\store;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\games;
use Illuminate\Http\Request;

class cartController extends Controller
{
    use ApiResponse;

    public function createCart()
    {
        $cart = cart::where('user_id', auth()->id())->first();
        if ($cart) {
            return $this->success($cart, 'Cart Already Exists');
        }
        $cart = cart::create([
            'user_id' => auth()->id()
        ]);
        return $this->success($cart, 'Cart Created Successfully');
    }

    public function getCart()
    {
        try {
            $cart = cart::where('user_id', auth()->id())->first();
            $cartItems = cartItems::where('cart_id', $cart->id)->get();
            $cartPlucked = $cartItems->pluck('games_id');
            $games = games::whereIn('id', $cartPlucked)->get();
            $total = 0;
            foreach ($cartItems as $item) {
                $total += (float) $item->games->price * (int) $item->quantity;
            }
            return $this->success(['total' => $total, 'cartItems' => $cartItems, 'games' => $games], 'Cart Items Fetched Successfully');

        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }

    }

    public function addToCart(Request $request)
    {
        try {
            $cart = cart::where('user_id', auth()->id())->first();
            $game = games::find(request('id'));
            cartItems::create([
                'games_id' => $game->id,
                'cart_id' => $cart->id,
                'quantity' => $request->quantity
            ]);
            return $this->success($game, 'Game Added To Cart Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $cart = cart::where('user_id', auth()->id())->first();
            $game = games::find(request('id'));
            if (!$game) {
                cartItems::create([
                    'games_id' => $game->id,
                    'cart_id' => $cart->id,
                    'quantity' => $request->quantity
                ]);
            }
            cartItems::where('cart_id', $cart->id)->where('games_id', $game->id)->update([
                'quantity' => $request->quantity
            ]);
            return $this->success($game, 'Game Quantity Updated Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function removeFromCart()
    {
        $cart = cart::where('user_id', auth()->id())->first();
        $game = games::find(request('id'));
        try {
            $item = cartItems::where('cart_id', $cart->id)->where('games_id', $game->id)->first();
            if (!$item) {
                return $this->notFound('Game Not Found');
            }
            $item->delete();
            return $this->noContent();
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }
}