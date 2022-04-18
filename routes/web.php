<?php

use Illuminate\Support\Facades\Route;
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

//=====ログイン画面表示=========
Auth::routes();
Route::get('/', function () { return view('/auth/login'); });

//=======商品一覧画面=========
Route::get('/product',[App\Http\Controllers\ProductController::class,'showList']) -> name('showList')->middleware('auth');

//Ajax商品一覧２ページ目以降
Route::get('/product/ajaxList',[App\Http\Controllers\ProductController::class,'ajaxList']) -> name('ajaxList')->middleware('auth');

//=======通常商品検索========
// Route::post('/product/search',[App\Http\Controllers\ProductController::class,'exeSearch']) -> name('search')->middleware('auth');

//=====Ajax商品検索==========
Route::get('/product/search',[App\Http\Controllers\ProductController::class,'ajaxSearch']) -> name('ajaxSearch')->middleware('auth');

//======商品登録画面========
Route::get('/product/create',[App\Http\Controllers\ProductController::class,'showCreate']) -> name('create')->middleware('auth');

//======商品登録画面========
Route::post('/product/store',[App\Http\Controllers\ProductController::class,'exeStore']) -> name('store');

//======商品詳細画面========
Route::get('/product/{id}',[App\Http\Controllers\ProductController::class,'showDetail']) -> name('detail')->middleware('auth');

//======商品編集画面========
Route::get('/product/edit/{id}',[App\Http\Controllers\ProductController::class,'showEdit']) -> name('edit')->middleware('auth');

//======商品編集更新========
Route::post('/product/update',[App\Http\Controllers\ProductController::class,'exeUpdate']) ->name('update');

//======Ajax商品削除==========
Route::delete('/product/delete/{id}',[App\Http\Controllers\ProductController::class,'destroy'])->name('destroy');

//CSV出力
Route::get('/product/search',[App\Http\Controllers\ProductController::class,'exportCSV']) -> name('exportCSV');
