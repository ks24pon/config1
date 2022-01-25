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
}
