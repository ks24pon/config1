<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UesrController extends Controller
{
  // ユーザーページ表示のメソッド
  public function show(string $name)
  {
    $user = User::where('name', $name)->first();

    return view('user.show', [
      'user' => $user,
    ]);
  }
}
