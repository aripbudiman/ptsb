<?php

namespace App\Http\Controllers\API;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;

class BranchController extends Controller
{
    public function getAllBranches(){
        $branches = Branch::all();
        return response()->json($branches,200);
    }

    public function store(BranchRequest $request){
        try{
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            Branch::create($data);
            return response()->json(['message'=>'Branch created successfully'],200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
        
    }

    public function getBranchById(Branch $branch){
        return response()->json($branch,200);
    }

    public function update(BranchRequest $request,Branch $branch){
        try{
            $validate=$request->validated();
            $branch->update($validate);
            return response()->json(['message'=>'Branch updated successfully'],200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function destroy(Branch $branch){
        try{
            $branch->delete();
            return response()->json(['message'=>'Branch deleted successfully'],200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
