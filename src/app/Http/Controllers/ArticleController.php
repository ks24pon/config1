<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
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
    // Articleモデルのインスタンスであるtitleとbodyを代入
    $article->title = $request->title;
    $article->body = $request->body;
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
}
