<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  // showアクションメソッドで引数$nameを受け取る
  public function show(string $name)
  {
    // whereメソッドで最大でも１件取得
    $user = User::where('name', $name)->first();
    // User.phpで書いたarticlesを使いユーザーの投稿した記事モデルをコレクションで取得
    $articles = $user->articles->sortByDesc('created_at');
    // viewメソッドを使ってusers/show.blade.phpを表示
    return view('users.show', [
      'user' => $user,
      'articles' => $articles,
    ]);
  }
  // いいねした記事一覧を表示した状態のユーザーページ
  public function likes(string $name)
  {
    // $userに最大での１件を取得させている
    $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);
    // 変数$articlesにユーザーがいいねした記事モデルを代入
    $articles = $user->likes->sortByDesc('created_at');
    // 表示するbladeはresources/views/users/likes.blade.php
    return view('users.likes', [
      'user' => $user,
      'articles' => $articles,
    ]);
  }
  // フォロー一覧表示
  public function followings(string $name)
  {
    // $userに最大で１件を取得させている
    $user = User::where('name', $name)->first()->load('followings.followers');
    // User.phpのfollowingsを使用してUser.phpをコレクションで取得
    $followings = $user->followings->sortByDesc('created_at');
    // users/followingsのbladeを表示
    return view('users.followings', [
      'user' => $user,
      'followings' => $followings,
    ]);
  }
  // フォロワー一覧表示
  public function followers(string $name)
  {
    // $userに最大で１件を取得
    $user = User::where('name', $name)->first();
    // User.phpのfollowersを使用してUser.phpをコレクションで取得
    $followers = $user->followers->sortByDesc('created_at');
    // users/followersのbladeを表示
    return view('users.followers', [
      'user' => $user,
      'followers' => $followers,
    ]);
  }
  // フォロー機能
  public function follow(Request $request, string $name)
  {
    // whereメソッドでユーザーモデルをコレクションとして渡してfirstメソッドで最初の１けんのユーザーを取得
    $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

    // 自分自身をフォローできないようにする
    if ($user->id === $request->user()->id) {
      // abort関数で第一引数にステータスコードを渡す
      return abort('404', 'Cannot follow yourself');
      // 一人のユーザーが複数重ねてフォローできないようにdetachから実装
      $request->user()->followings()->detach($user);
      $request->user()->followings()->attach($user);
      // レスポンスをユーザー名で返す
      return ['name' => $name];
    }
  }

  // フォロー解除機能
  public function unfollow(Request $request, string $name)
  {
    // whereメソッドでUserモデルをコレクションに渡しfirstメソッドで最初の１件のユーザーを取得
    $user = User::where('name', $name)->first();
    // 自分自身をフォローできないようにする
    if ($user->id === $request->user()->id) {
      // abort関数で第一引数にステータスコードを渡す
      return abort('404', 'Cannot follow yourself.');
    }
    // 削除のみ
    $request->user()->followings()->detach($user);
    // レスポンスのユーザー名で返す
    return ['name' => $name];
  }
}
