<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function getAllOrder()
    {
        $data = Order::getAllOrder();
        return response()->json($data, 200);
    }

    public function getOrderPending()
    {
        $data = Order::getOrderPending();
        return response()->json($data, 200);
    }

    public function addToCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $check = Order::checkOrder();
            $product = $request->all();
            Order::addToCart($check, $product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e, 500);
        }
        return response()->json($request->all(), 200);
    }

    public function incrementOrder(DetailOrder $order)
    {
        $order->increment('qty');
        return response()->json($order, 200);
    }

    public function decrementOrder(DetailOrder $order)
    {
        if ($order->qty == 1) {
            $order->delete();
            return response()->json('success', 200);
        }
        $order->decrement('qty');
        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json('success', 200);
    }
}
