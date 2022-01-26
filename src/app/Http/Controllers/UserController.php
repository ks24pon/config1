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
    // viewメソッドを使ってusers/show.blade.phpを表示
    return view('users.show', [
      'user' => $user,
    ]);
  }
  // フォロー機能
  public function follow(Request $request, string $name)
  {
    // whereメソッドでユーザーモデルをコレクションとして渡してfirstメソッドで最初の１けんのユーザーを取得
    $user = User::where('name', $name)->first();

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
