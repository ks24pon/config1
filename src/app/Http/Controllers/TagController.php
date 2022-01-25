<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
  // 引数$nameを受け取る
  public function show(string $name)
  {
    // firstメソッドを使って最初のタグモデルを取り出し変数$tagに代入
    $tag = Tag::where('name', $name)->first();
    // tags/show.blade.phpを表示させbladeに変数$tagを渡している
    return view('tags.show', ['tag' => $tag]);
  }
}
