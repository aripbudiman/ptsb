<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getAllOrder(){
        $data=Order::getAllOrder();
        return response()->json($data,200);
    }

    public function getOrderPending(){
        $data=Order::getOrderPending();
        return response()->json($data,200);
    }

    public function addToCart(Request $request){
        Order::create([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->product_id,
            'qty'=>1
        ]);
        return response()->json('success',200);
    }

    public function incrementOrder(Order $order){
        $order->increment('qty');
        return response()->json($order,200);
    }

    public function decrementOrder(Order $order){
        $order->decrement('qty');
        return response()->json($order,200);
    }

    public function destroy(Order $order){
        $order->delete();
        return response()->json('success',200);
    }

}
