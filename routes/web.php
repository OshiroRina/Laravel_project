<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Company;

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

Auth::routes();
Route::get('/home',  [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログイン画面表示
Route::get('/', function () {
    return view('/auth/login');
});


//商品一覧画面
Route::get('/product',[App\Http\Controllers\ProductController::class,'showList']) -> name('showList');

//社員一覧
// Route::get('/company',[App\Http\Controllers\CompanyController::class,'companyList']) -> name('companyList');

//商品登録画面
Route::get('/product/create',[App\Http\Controllers\ProductController::class,'showCreate']) -> name('create');

//商品登録画面
Route::post('/product/store',[App\Http\Controllers\ProductController::class,'exeStore']) -> name('store');

//商品詳細画面
Route::get('/product/{id}',[App\Http\Controllers\ProductController::class,'showDetail']) -> name('showDetail');

//商品編集画面
Route::get('/product/{id}',[App\Http\Controllers\ProductController::class,'editList']) -> name('edit');