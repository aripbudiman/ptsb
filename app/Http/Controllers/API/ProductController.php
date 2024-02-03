<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function getAllProducts(){
        $products = Product::getAllProduct();
        return response()->json($products,200);
    }

    public function store(ProductRequest $request){
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = 'products/'.uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/', $image_name);
                $data['image'] = $image_name;
            }
            Product::create($data);
            return response()->json([
                'message' => 'Product created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function getProductById(Product $product){
        return response()->json($product,200);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = 'products/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public', $image_name);
                $data['image'] = $image_name;
            } else {
                $data['image'] = $product->image;
            }
            $product->update($data);
    
            return response()->json([
                'message' => 'Product updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    
    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }

}
