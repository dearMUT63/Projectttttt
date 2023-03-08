<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TransactionController extends Controller
{
    public function index() {
        $orders = Order::where('status', Order::STATUS['0'])
                     ->whereNotNull('slip')->get();
                return view('backend.transaction',compact('orders'));
    }
    public function approve(Order $order) {
        $order->update([
            'status' => 'approve'
        ]);
        return back()->with('success','success');
    }
    public function reject(Order $order) {
        $order->update([
            'status' => 'reject'
        ]);
        return back()->with('success','success');

    }
    public function cancel(Order $order) {
        $order->update([
            'status' => 'cancel'
        ]);
        return back()->with('success','success');

    }
}
