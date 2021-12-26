<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LiveSearchController;
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




//ログイン画面表示
Auth::routes();

Route::get('/', function () { return view('/auth/login'); });


//商品一覧画面
Route::get('/product',[App\Http\Controllers\ProductController::class,'showList']) -> name('showList')->middleware('auth');


//商品検索

Route::post('/product',[App\Http\Controllers\ProductController::class,'exeSearch']) -> name('search')->middleware('auth');
// Route::get('/read',[App\Http\Controllers\LiveSearchController::class,'read']);

//社員一覧
// Route::get('/company',[App\Http\Controllers\CompanyController::class,'companyList']) -> name('companyList');

//商品登録画面
Route::get('/product/create',[App\Http\Controllers\ProductController::class,'showCreate']) -> name('create')->middleware('auth');

//商品登録画面
Route::post('/product/store',[App\Http\Controllers\ProductController::class,'exeStore']) -> name('store');

//商品詳細画面
Route::get('/product/{id}',[App\Http\Controllers\ProductController::class,'showDetail']) -> name('detail')->middleware('auth');

//商品編集画面
Route::get('/product/edit/{id}',[App\Http\Controllers\ProductController::class,'showEdit']) -> name('edit')->middleware('auth');

//商品編集更新

Route::post('/product/update',[App\Http\Controllers\ProductController::class,'exeUpdate']) ->name('update');

//商品削除
Route::post('/product/delete/{id}',[App\Http\Controllers\ProductController::class,'exeDelete']) -> name('delete');

