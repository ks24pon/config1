@extends('app')

@section('title', 'コムジョ Top画面')

@section('content')
@include('nav')
@guest
<div class="container">
  <div class="row">
        <!-- サイトタイトル -->
        <div class="col-lg-6 my-2">
            <div class="main-title">
                <i class="fas fa-star"></i>
                <span class="logo_style">コムジョ</span>
            </div>
        </div>

        <div class="site-consept text-center my-2">
        <!-- <div class="col-lg-6 my-2"> -->
            <img src="{{ asset('img/coffee-2511065.jpg') }}" width="100%">
        </div>
    </div>
</div>

<!-- サイトの説明 -->
<div class="site-consept text-center my-2">
    <p class="sub-title mb-1">コムジョとは</p>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="sub-body mb-1">
                    コムジョとは公務員試験に1歩でも合格に近づけるためのサイトです。<br class="br-sm">
                    公務員の方や受験生同士の情報交換をして知識をシェアをしよう！！<br class="br-sm">
                    このサイトでは公務員に関連する内容を投稿・参考にお使いください！
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-7">
            <!-- 検索 -->
            <form method="GET" action="{{ route('articles.index') }}" class="d-flex">
                <input class="form-control me-2 mt-3" name="search" value="{{ request('search') }}" type="search" placeholder="キーワードを入力" aria-label="Search">
                <button class="btn btn-outline-info mt-3 mb-0 ml-0 py-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

@endguest
  <!-- 記事一覧 -->
  @foreach($articles as $article)
  @include('articles.card')
  @endforeach
</div>
@endsection
