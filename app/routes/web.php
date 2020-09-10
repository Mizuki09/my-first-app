<?php

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

//カテゴリ別の動画一覧
Route::get('/category/{category}', 'AppController@index');
//APIを使った動画の追加
Route::post('/category/apiCreate', 'ApiController@apiVideo')->middleware('auth');
//動画の追加
Route::post('/category/videoCreate', 'VideoController@videoAdd')->middleware('auth');
//動画の削除
Route::post('/category/videoDelete', 'VideoController@videoDelete')->middleware('auth');
//コメントの追加
Route::post('/category/commentCreate', 'CommentController@commentAdd')->middleware('auth');
//コメントの削除
Route::post('/category/commentDelete', 'CommentController@commentDelete')->middleware('auth');
//ユーザーデータの編集
Route::get('/{id}','UserController@edit');



Auth::routes();

Route::get('/', 'HomeController@index')->name('/');
//
//Auth::routes();
//
//Route::get('/', 'HomeController@index')->name('/');
//
//Auth::routes();
//
//Route::get('/', 'HomeController@index')->name('/');
