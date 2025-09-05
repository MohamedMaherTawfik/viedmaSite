<?php

namespace App\Http\Controllers\api\store;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\orderdetails;
use App\Models\orders;
use Illuminate\Http\Request;

class orderController extends Controller
{
    use apiResponse;

    public function allOrders()
    {
        $orders = orders::paginate(10);
        return $this->success($orders, 'all orders Fetched successfully');
    }

    public function createOrder()
    {
        $cart = cart::where('user_id', auth()->id())->first();
        $cartItems = cartItems::where('cart_id', $cart->id)->get();
        $price = 0;
        foreach ($cartItems as $item) {
            $price += $item->games->price * $item->quantity;
        }
        $quantity = 0;
        foreach ($cartItems as $item) {
            $quantity += $item->quantity;
        }
        try {
            $order = orders::create([
                'user_id' => auth()->id(),
                'price' => $price,
                'quantity' => $quantity
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
            return $this->success($order, 'order created successfully');

        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function getOrders()
    {
        $orders = orders::where('user_id', auth()->id())->get();
        if ($orders->isEmpty()) {
            return $this->noContent();
        }
        return $this->success($orders, 'all orders Fetched successfully');
    }

    public function getOrder()
    {
        $order = orders::find(request('id'));
        if (!$order) {
            return $this->notFound('order not found');
        }
        return $this->success($order, 'order Fetched successfully');
    }

    public function deleteOrder()
    {
        $order = orders::find(request('id'));
        if (!$order) {
            return $this->notFound('order not found');
        }
        $order->delete();
        return $this->noContent();
    }
}