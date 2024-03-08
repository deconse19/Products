<?php

use App\Http\Controllers\LoginController;
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

Route::group(['prefix'=>'product'], function() {
    Route::post('/', [ProductController::class, 'index']);
    Route::post('add', [ProductController::class, 'add']);
    Route::post('update', [ProductController::class, 'update']);
});

Route::group(['prefix'=>'login'], function() {
    Route::post('/', [LoginController::class, 'logIn']);
    Route::post('signup', [LoginController::class, 'signUp']);
});


