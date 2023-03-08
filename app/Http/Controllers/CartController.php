<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Auth::user()->carts;
        return view('frontend.cart',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->get('product_id');
        // TODO:save product to cart
        // Cart::create([
        //     'user_id' => $user->id,
        //     'product_id' => $product_id,
        //     'quantity' => 1
        // ]);
        $cart =Cart::firstOrNew([
            'user_id' => $user->id,
            'product_id' => $product_id
        ]);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return back()->with('success','Add product to cart successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkOut(Request $request)
    {
        $user_id = $request->user_id;
        $carts = Cart::where('user_id', $user_id);

        $order = new Order;
        $order->fill($request->all());
        $order->save();

        foreach ($carts->get() as $key => $cart) {
            $orderDetail = new OrderDetail;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->order_id = $order->id;
            $orderDetail->save();
        }
        $carts->delete();
        return back()->withSuccess('Order successfull');
    }
    public function plus(Cart $cart)
    {
        $cart->quantity += 1;
        $cart->save();
        return back();
    }
    public function minus(Cart $cart)
    {
        if($cart->quantity > 0) {
            $cart->quantity -= 1;
            $cart->save();
        }
        return back();
    }
}

