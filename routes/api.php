<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
Route::post('/newProduct', [ProductController::class, 'save_product']);
Route::put('/update-product/{id}', [ProductController::class, 'update']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::delete('/product-delete/{id}', [ProductController::class, 'delete']);
