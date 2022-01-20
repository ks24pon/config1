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
  }
}
