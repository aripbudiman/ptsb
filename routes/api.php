<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


Route::post('login',[AuthController::class,'store'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('users',[AuthController::class,'index'])->name('users');
});
