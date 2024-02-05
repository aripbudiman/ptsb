<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'tanggal'=>'required',
            'order_id'=>'required|numeric',
            'total_amount'=>'required|numeric',
            'cash'=>'required|numeric',
            'payment_method'=>'required',
        ];
    }
}
