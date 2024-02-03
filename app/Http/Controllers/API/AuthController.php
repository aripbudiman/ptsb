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
        if(Auth::check()){
            $data=User::all(['id','name','email','role','branch_id']);
            return response()->json($data,200);
        }else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
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

    public function getUserById($id){
        $user=User::findOrFail($id);
        return response()->json($user,200);
    }

    public function update(Request $request, $id){
        $user=User::findOrFail($id);
        $validator=Validator::make($request->all(), [
            'email'=>'required|email',
            'name'=>'required',
            'role'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }else{
            $user->update($request->all());
            return response()->json(['message' => 'User Updated'],200);
        }
    }

    public function destroy(User $user){
        try {
            $user->delete();
            return response()->json(['message' => 'User Deleted'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'User cannot be deleted'], 422);
        }
    }

    public function getUserWithBranch(){
        $data=User::with('branch')->get();
        return response()->json($data,200);
    }
    
}
