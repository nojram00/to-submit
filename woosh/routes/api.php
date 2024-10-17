<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/user', function(){
        $user = Auth::user();

        return $user;
    });

    Route::controller(ProductsController::class)->group(function(){

        Route::get('/products', 'index');

        Route::get('/product-data', 'data');

        Route::post('/add-product', 'store');

        Route::get('/product/{product}', 'show');

        Route::delete('product/{product}', 'destroy');

    });

    Route::post('/logout', [UserController::class, 'logout']);

});


Route::post('/login', [UserController::class, 'login'])->name('login');


Route::get('/unauthorized', function(){
    return \response()->json([
        'message' => 'Unathorized User'
    ], 401);
})->name('unathorized-fallback');
