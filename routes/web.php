<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AccountsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//アカウント登録画面
Route::get('/form', [App\Http\Controllers\AccountsController::class, 'regist']);
//アカウント登録確認画面
Route::post('/confirm', [App\Http\Controllers\AccountsController::class, 'regist_post']);
//アカウント登録完了画面
Route::post('/complete',[App\Http\Controllers\AccountsController::class, 'store']);
//トップページ'
Route::get('/top', [App\Http\Controllers\AccountsController::class, 'top']);
//アカウント一覧
Route::get('/list', 'App\Http\Controllers\AccountsController@index');
//アカウント削除
Route::get('/delete','App\Http\Controllers\AccountsController@account_deletion');
//アカウント削除確認画面
Route::post('/delete_confirm', 'App\Http\Controllers\AccountsController@delete_confirm');
//アカウント削除完了画面
Route::post('/delete_complete', 'App\Http\Controllers\AccountsController@delete_complete');
//アカウント更新
Route::get('/update','App\Http\Controllers\AccountsController@account_update');
//アカウント更新確認
Route::post('/update_confirm','App\Http\Controllers\AccountsController@update_confirm');
//アカウント更新完了
Route::post('/update_complete','App\Http\Controllers\AccountsController@update_complete');

