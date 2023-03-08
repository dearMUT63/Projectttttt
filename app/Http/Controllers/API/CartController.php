<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function increment(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            if ($product_id && $user_id) {
                $cart = Cart::where('product_id', $product_id)
                            ->where('user_id', $user_id)->first();
                // Solution 1
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
                return response()->json([
                    'status' => 'success',
                    'quantity' => $cart->quantity
                ]);

                // Solution 2
                // $cart->update([
                //     'quantity' => $cart->quantity + 1
                // ]);
            }
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function decrement(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            if ($product_id && $user_id) {
                $cart = Cart::where('product_id', $product_id)
                            ->where('user_id', $user_id)->first();
                // Solution 1
                $cart->quantity = $cart->quantity - 1;
                $cart->save();
                return response()->json([
                    'status' => 'success',
                    'quantity' => $cart->quantity
                ]);

                // Solution 2
                // $cart->update([
                //     'quantity' => $cart->quantity + 1
                // ]);
            }
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function remove(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            if ($product_id && $user_id) {
                Cart::where('product_id', $product_id)
                    ->where('user_id', $user_id)->delete();
                return response()->json([
                    'status' => 'success',
                ]);

                // Solution 2
                // $cart->update([
                //     'quantity' => $cart->quantity + 1
                // ]);
            }
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function checkOut(Request $request){
        
    }
}
