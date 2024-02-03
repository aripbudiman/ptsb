<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;

Route::post('login',[AuthController::class,'store'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('users',[AuthController::class,'index'])->name('users');
    Route::get('users/{id}',[AuthController::class,'getUserById'])->name('users.edit');
    Route::put('users/{id}',[AuthController::class,'update'])->name('users.update');
    Route::delete('users/{user}',[AuthController::class,'destroy'])->name('users.delete');
    Route::get('/branch/users',[AuthController::class,'getUserWithBranch'])->name('users.branch');

    Route::get('branch',[BranchController::class,'getAllBranches'])->name('branch');
    Route::post('branch',[BranchController::class,'store'])->name('branch');
    Route::get('branch/{branch}',[BranchController::class,'getBranchById'])->name('branch.show');
    Route::put('branch/{branch}',[BranchController::class,'update'])->name('branch.update');
    Route::delete('branch/{branch}',[BranchController::class,'destroy'])->name('branch.delete');

    Route::get('category',[CategoryController::class,'getAllCategories'])->name('category');
    Route::post('category',[CategoryController::class,'store'])->name('category');
    Route::get('category/{category}',[CategoryController::class,'getCategoryById'])->name('category.show');
    Route::put('category/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('category/{category}',[CategoryController::class,'destroy'])->name('category.delete');

    Route::get('product',[ProductController::class,'getAllProducts'])->name('product');
    Route::post('product',[ProductController::class,'store'])->name('product');
    Route::get('product/{product}',[ProductController::class,'getProductById'])->name('product.show');
    Route::put('product/{product}',[ProductController::class,'update'])->name('product.update');
    Route::delete('product/{product}',[ProductController::class,'destroy'])->name('product.delete');
    
    Route::get('order',[OrderController::class,'getAllOrder'])->name('order');
    Route::get('order/pending',[OrderController::class,'getOrderPending'])->name('order.pending');
    Route::post('order/increment/{order}',[OrderController::class,'incrementOrder'])->name('order.increment');
    Route::post('order/decrement/{order}',[OrderController::class,'decrementOrder'])->name('order.decrement');
    Route::post('order',[OrderController::class,'addToCart'])->name('order.cart');
    Route::delete('order/{order}',[OrderController::class,'destroy'])->name('order.delete');
});
