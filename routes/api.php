<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/update_profile', [UserController::class, 'createProfile']);
    Route::post('/purchase', [UserController::class, 'userPurchase']);
});



Route::group(['prefix' => 'company'], function () {
    Route::post('/', [CompanyController::class, 'index']);
    Route::post('add', [CompanyController::class, 'add']);
    Route::post('update', [CompanyController::class, 'update']);

    Route::post('/create_product', [CompanyController::class, 'createProduct']);

    Route::post('add_product', [ProductController::class, 'add']);
    Route::post('update_product', [ProductController::class, 'update']);
   
});

