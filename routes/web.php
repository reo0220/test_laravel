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
    return view('auth/login');
});

Auth::routes();

//アカウント登録画面
Route::get('/form', [App\Http\Controllers\AccountsController::class, 'regist']);
//アカウント登録画面(前に戻るボタン押下時)
Route::post('/form', [App\Http\Controllers\AccountsController::class, 'regist_back']);
//アカウント登録確認画面
Route::post('/confirm', [App\Http\Controllers\AccountsController::class, 'regist_post']);
Route::get('/confirm', [App\Http\Controllers\AccountsController::class, 'login_error']);
//アカウント登録完了画面
Route::post('/complete',[App\Http\Controllers\AccountsController::class, 'store']);
Route::get('/complete',[App\Http\Controllers\AccountsController::class, 'login_error']);
//トップページ'
Route::get('/top', [App\Http\Controllers\AccountsController::class, 'top']);
Route::get('/home', [App\Http\Controllers\AccountsController::class, 'top']);
//アカウント一覧
Route::get('/list', [App\Http\Controllers\AccountsController::class,'index']);
//アカウント検索
Route::post('/search_list', [App\Http\Controllers\AccountsController::class,'search']);
//アカウント削除
Route::get('/delete',[App\Http\Controllers\AccountsController::class,'account_deletion']);
//アカウント削除確認画面
Route::post('/delete_confirm', [App\Http\Controllers\AccountsController::class,'delete_confirm']);
Route::get('/delete_confirm', [App\Http\Controllers\AccountsController::class,'login_error']);
//アカウント削除完了画面
Route::post('/delete_complete',[App\Http\Controllers\AccountsController::class,'delete_complete']);
Route::get('/delete_complete',[App\Http\Controllers\AccountsController::class,'login_error']);
//アカウント更新
Route::get('/update',[App\Http\Controllers\AccountsController::class,'account_update']);
//アカウント更新確認
Route::post('/update_confirm',[App\Http\Controllers\AccountsController::class,'update_confirm']);
Route::get('/update_confirm',[App\Http\Controllers\AccountsController::class,'login_error']);
//アカウント更新完了
Route::post('/update_complete',[App\Http\Controllers\AccountsController::class,'update_complete']);
Route::get('/update_complete',[App\Http\Controllers\AccountsController::class,'login_error']);

    
  
  
  




