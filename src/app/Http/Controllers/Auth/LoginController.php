<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
  // Googleログイン機能
  public function redirectToProvider(string $provider)
  {
    // driverメソッドで外部のサービス名を渡す
    return Socialite::driver($provider)->redirect();
  }
  // Googleアカウントでログイン処理
  public function handleProviderCallback(Request $request, string $provider)
  {
    // Googleからユーザー情報を取得
    $providerUser = Socialite::driver($provider)->stateless()->user();
    // Googleのメールアドレスを元にユーザーモデルを取得
    $user = User::where('email', $providerUser->getEmail())->first();
    // ログイン処理
    if ($user) {
      // ユーザーをログイン状態
      $this->guard()->login($user, true);
      // ログイン後に記事一覧画面に遷移
      return $this->sendLoginResponce($request);
    }
  }
}
