@extends('app')

@section('title', 'コムジョ ログイン')

@section('content')
@include('nav')
<div class="container my-5">
  <div class="row">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card-body text-center">
          <form method="POST" class="text-center border border-light p-5" action="{{ route('login') }}">
            @csrf
            <p class="h4 mb-4">ログイン</p>

          <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-green mb-2">
            <i class="fab fa-google mr-1"></i>Googleでログイン
          </a>

          <a href="{{ route('login.{provider}', ['provider' => 'twitter']) }}" class="btn btn-block btn-info">
            <i class="fab fa-twitter mr-1"></i>Twitterでログイン
          </a>

          @include('error_card_list')

            <div class="md-form">
                <label for="email">メールアドレス<snall class="text-warning ml-1">[必須]</small></label>
                <input class="form-control mb-4" type="text" id="email" name="email" required value="{{ old('email') }}">
              </div>

              <div class="md-form">
                <label for="password">パスワード<small class="text-warning ml-1">[必須]</small></label>
                <input class="form-control mb-4" type="password" id="password" name="password" required>
              </div>
              <!-- 次回から自動でログインする -->
              <input type="hidden" name="remember" id="remember" value="on">

              <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ログイン</button>

              <a href="{{ route('login.guest') }}" class="btn btn-block btn-red">ゲストでログイン</a>
            <div class="mt-0">
              <a href="{{ route('register') }}" class="text-muted">ユーザー登録はこちら</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
