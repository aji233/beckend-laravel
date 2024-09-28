<?php

use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/product',[ProductController::class, 'index']);
Route::post('/product',[ProductController::class, 'store']);
Route::put('/product',[ProductController::class, 'update']);
Route::delete('/product',[ProductController::class, 'destroy']);

