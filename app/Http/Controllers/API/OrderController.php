<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        $check=Order::checkOrder();
        $product=$request->all();
        if(!$check){
            $order=Order::create([
                'branch_id'=>Auth::user()->branch_id,
            ]);
            foreach($product as $item){
                DetailOrder::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item['product_id'],
                    'qty'=>$item['qty'],
                ]);
            }
        }else{
            $order=Order::orderExists();
            foreach($product as $item){
                DetailOrder::firstOrCreate([
                    'order_id'=>$order,
                    'product_id'=>$item['product_id'],
                    'qty'=>$item['qty'],
                ]);
            }
        }
        return response()->json('Order create',200);
    }

    public function incrementOrder(DetailOrder $order){
        $order->increment('qty');
        return response()->json($order,200);
    }

    public function decrementOrder(DetailOrder $order){
        if($order->qty==1){
            $order->delete();
            return response()->json('success',200);
        }
        $order->decrement('qty');
        return response()->json($order,200);
    }

    public function destroy(Order $order){
        $order->delete();
        return response()->json('success',200);
    }

}
