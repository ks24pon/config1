<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Article::class, 'article');
  }

  public function index()
  {
    $articles = Article::all()->sortByDesc('created_at');
    return view('articles.index', ['articles' => $articles]);
  }

  // 記事投稿画面
  public function create()
  {
    return view('articles.create');
  }

  // 記事投稿処理
  public function store(ArticleRequest $request, Article $article)
  {
    // allメソッドで記事投稿から送信されたPOSTリクエストのパラメーターを取得
    $article->fill($request->all());
    $article->user_id = $request->user()->id;
    $article->save();
    return redirect()->route('articles.index');
  }

  // 記事編集画面
  // Article $articleと型宣言することでArticleモデルのインスタンスのDIが行われる
  public function edit(Article $article)
  {
    // viewメゾットによりarticlesにあるeditという名前のビューを表示する
    return view('articles.edit', ['article' => $article]);
  }

  // 記事編集処理
  public function update(ArticleRequest $request, Article $article)
  {
    $article->fill($request->all())->save();
    return redirect()->route('articles.index');
  }

  // 記事削除処理
  public function destroy(Article $article)
  {
    $article->delete();
    return redirect()->route('articles.index');
  }

  // 記事詳細画面の表示
  public function show(Article $article)
  {
    return view('articles.show', ['article' => $article]);
  }

  // いいね機能likeメソッド
  public function like(Request $request, Article $article)
  {
    // 削除
    $article->likes()->detach($request->user()->id);
    // 新規登録
    $article->likes()->attach($request->user()->id);

    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }

  // いいね機能unlikeメソッド
  public function unlike(Request $request, Article $article)
  {
    // 削除
    $article->likes()->detach($request->user()->id);

    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }
}
