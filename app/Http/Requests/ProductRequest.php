<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' => 'required|exists:App\Models\Categories,id',
            'price' => 'required|numeric',
        ];
    }
}
