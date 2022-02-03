<?php

use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//商品購入処理のAPI
Route::post('/sale/buy', [App\Http\Controllers\API\SaleController::class,'buy']);

Route::post('/sale/add', [App\Http\Controllers\API\SaleController::class,'store']);

Route::delete('/product/delete/{id}',[App\Http\Controllers\ProductController::class,'deleteApi']) -> name('deleteApi');