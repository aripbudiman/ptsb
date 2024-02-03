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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getAllOrder(){
        $user=Auth::id();
        $order=Order::where('user_id',$user)->with('product')->get();
        return $order;
    }

    public static function getOrderPending(){
        $user=Auth::id();
        $order=Order::where('user_id',$user)->where('status','pending')->with('product')->get();
        return $order;
    }
    
}
