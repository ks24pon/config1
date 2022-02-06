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
Auth::routes();
// Googleログインのボタンを押した後のルーティング
Route::prefix('login')->name('login.')->group(function () {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
  // Googleアカウントが選択されるとパスワード不要でログインできるルーティング
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
// ゲストログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');
// ユーザー名登録画面表示処理のルーティング
Route::prefix('register')->name('register.')->group(function () {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  // Googleの垢でユーザー登録する
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});
Route::get('/', 'ArticleController@index')->name('articles.index');
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
// ユーザーページ
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  // いいねタブが押された場合のユーザーページ表示のルーティング
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  // フォロー・フォロワーの一覧のルーティング（未ログインユーザーでも参照可能にauthからはずす
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  // フォロー機能のルーティング
  Route::middleware('auth')->group(function () {
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});
// タグ別記事一覧画面のルーティング
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
