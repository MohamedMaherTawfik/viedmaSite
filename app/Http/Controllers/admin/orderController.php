<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orderdetails;
use App\Models\orders;

class orderController extends Controller
{
    public function index()
    {
        $orders = orders::where('transaction_status', 'pending')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(orders $order)
    {
        $orderdetails = orderdetails::where('orders_id', $order->id)->get();
        return view('admin.orders.show', compact('order', 'orderdetails'));
    }

    public function update(orders $order)
    {
        $order->update(['transaction_status' => request('transaction_status'), 'price' => request('price'), 'quantity' => request('quantity')]);
        return redirect()->back()->with('success', 'order updated successfully');
    }
}
