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

Route::get('/', 'ArticleController@index')->name('articles.index');
Auth::routes();
// 記事関連のルーティング
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
//記事詳細のルーティング
Route::resource('/articles', 'ArticleController')->only(['show']);
// いいね機能のルーティング
Route::prefix('articles')->name('articles.')->group(function () {
  // いいねしたルーティング
  Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
  // いいね外したルーティング
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
