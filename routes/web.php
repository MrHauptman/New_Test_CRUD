<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Moderator\ModeratorController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProductController;

 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::patch('/profile/change-mode', [ProfileController::class, 'changeMode'])->name('profile.changeMode');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('moderator/dashboard/{slug}', [ModeratorController::class, 'dashboard'])->name('moderator.dashboard');
    
   
    
});
Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/seller/dashboard/{slug}', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/products/own/index', [ProductController::class, 'myProducts'])->name('product.own');
    
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    //Route::patch('/products/redact', [ProductController::class, 'redact'])->name('products.redact');
    Route::patch('/products/update/{id}', [ProductController::class, 'redact'])->name('product.redact');
    
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
  
    Route::get('product/update', [ProductController::class, 'update'])->name('product.update');
       
});
    
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard/{slug}', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{id}/purchase',[ProductController::class, 'purchase'])->name('product.purchase');
    Route::post('/profile/balance/update', [ProfileController::class,'refillBalance'])->name('profile.balance');
    Route::get('/profile/balance/form',[ProfileController::class, 'BalanceForm'])->name('profile.BalanceForm');
    Route::post('/purchase', [ProductController::class, 'purchase']);
  

});
require __DIR__.'/auth.php';
