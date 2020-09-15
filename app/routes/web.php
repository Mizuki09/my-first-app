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
//ユーザーデータの編集画面の表示
Route::get("/edit/{id}",'UserController@edit');
//ユーザーデータの編集
Route::post("/update",'UserController@update');


//管理者のみ利用可能
Route::group(['middleware'=>['auth','can:admin']],function (){
//    管理者画面
    Route::get('/admin','AdminController@index');
//    ユーザーデータの個別編集画面
    Route::get("/admin/{id}",'AdminController@edit');
//    ユーザーデータ編集送信
    Route::post("/admin/edit/{id}",'AdminController@update');
});



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
