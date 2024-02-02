<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function index()
    {
        $data=User::all(['name','email','role']);
        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $token= $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message'=>'Login Success',
            ])->setStatusCode(200);
        }else{
            return response()->json(['message' => 'Login failed email or password tidak sesuai'], 401);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
