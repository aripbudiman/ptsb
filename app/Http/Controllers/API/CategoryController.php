<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function getAllCategories(){
        $categories = Categories::all();
        return response()->json($categories,200);
    }

    public function store(CategoryRequest $request){
        try{
            $categories=$request->validated();
            Categories::create($categories);
            return response()->json(['message'=>'Category created successfully'],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

    public function getCategoryById(Categories $category){
        try{
            return response()->json($category,200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

    public function update(CategoryRequest $request,Categories $category){
        try{
            $categories=$request->validated();
            $category->update($categories);
            return response()->json(['message'=>'Category updated successfully'],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

    public function destroy(Categories $category){
        try{
            $category->delete();
            return response()->json(['message'=>'Category deleted successfully'],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

}
