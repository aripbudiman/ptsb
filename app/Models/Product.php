<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Categories::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public static function getAllProduct(){
        $branch=Auth::user()->branch_id;
        $products=Product::where('branch_id',$branch)->with('category')->get();
        return $products;
    }
}
