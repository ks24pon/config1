@extends('app')

@section('title', '公務員試験投稿')

@include('nav')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-10 col-md-12 mx-auto my-5">
      <div class="card mt-5 mb-5">
        <div class="card-body text-center">
          <h2 class='h4 card-title text-center mt-5 mb-1'><span class="bg cyan grey white text-block py-3 px-4">投稿</span></h2>

          @include('error_card_list')

          <div class="card-text">
            <form method="POST" action="{{ route('articles.store') }}">
              @include('articles.form')
              <button type="submit" class="btn btn-block cyan darken-3 text-white col-lg-6 col-md-7 col-sm-8 col-xs-10 mx-auto mt-5">
                <i class="fas fa-pen mr-1"></i>投稿する
              </button>
              <a class='btn btn-block grey text-white waves-effect col-lg-6 col-md-7 col-sm-8 col-xs-10 mx-auto mt-3 mb-5' href="{{ route('articles.index') }}">戻る</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
