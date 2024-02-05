<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function payNow(TransactionRequest $request){
        $invoice=Transaction::invoice();
        $data=$request->validated();
        $data['user_id']=Auth::user()->id;
        $data['branch_id']=Auth::user()->branch_id;
        $data['invoice']=$invoice;
        Transaction::create($data);
        return response()->json($invoice,200);
    }
}
