<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'branch_code'=>['required', 'string'],
            'address'=>['required', 'string'],
            'description'=>['required', 'string'],
        ];
    }
}
