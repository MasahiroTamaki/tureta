<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログイン後の処理
    protected function authenticated(Request $request, $user)
    {
      // ログインしたら、ユーザー自身のプロフィールページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('users/'.$user->id)->with('my_status', 'ログインしました。');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
      $this->guard()->logout();
      $request->session()->invalidate();

      // ログアウトしたらトップページへ移動。フラッシュメッセージをsessionに保存。
      return $this->loggedOut($request) ?: redirect('/')->with('my_status', 'ログアウトしました。');
    }
}
