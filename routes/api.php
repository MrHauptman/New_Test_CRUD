<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth', 'seller'])->group(function () {
  
    Route::get('/products/index', [ProductController::class, 'index'])->name('products.show');
    Route::put('/products/update/{product}', [ProductController::class, 'update']);
    Route::delete('/products/delete/{product}', [ProductController::class, 'destroy']);
   
});

   

