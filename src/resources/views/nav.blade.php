<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarNav4">

    <a class="navbar-brand" href="/">
      <i class="far fa-star"></i>
      <span class="logo_style">コムジョ</span>
    </a>

    <ul class="navbar-nav ml-auto mt-lg-0">
      <!-- ログイン前に表示 -->
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      @endguest

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login.guest') }}">ゲストログイン</a>
      </li>
      @endguest
      <!-- ログイン後の表示 -->
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
      </li>
      @endauth

      @auth
      <!-- Dropdown -->

      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
            マイページ
          </button>
          <div class=" dropdown-divider">
            </div>
            <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form> -->
    <!-- Dropdown -->
    @endauth

  </ul>
  </div>
</nav>
