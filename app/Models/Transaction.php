<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    protected $table='transactions';
    protected $guarded=[];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function invoice(){
        $transaction=DB::table('transactions')->count();
        $year=now()->year;
        if($transaction){
            $number=$transaction+1;
        }else{
            $number=1;
        }
        return 'INV/'.$year.'/'.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    
}
