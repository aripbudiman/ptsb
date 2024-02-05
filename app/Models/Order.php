<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $guarded=[];
    

    public static function getAllOrder(){
        $user=Auth::user()->branch_id;
        $order=Order::where('branch_id',$user)->with('product')->get();
        return $order;
    }

    public static function getOrderPending(){
        $user=Auth::user()->branch_id;
        $order=Order::where('branch_id',$user)->where('status','pending')->with('details','details.product','details.product.category')->get();
        return $order;
    }

    public function details(){
        return $this->hasMany(DetailOrder::class,'order_id','id');
    }

    public static function checkOrder(){
        $user=Auth::user()->branch_id;
        $order=Order::where('branch_id',$user)->where('status','pending')->exists();
        return $order;
    }

    public static function orderExists(){
        $user=Auth::user()->branch_id;
        $order=Order::where('branch_id',$user)->where('status','pending')->first();
        return $order->id;
    }
    
}
