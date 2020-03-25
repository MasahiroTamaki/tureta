<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- CSRFトークン--}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
          {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          {{-- Navbarの左側 --}}
          <ul class="navbar-nav mr-auto">
            {{-- 「記事」と「ユーザー」へのリンク --}}
            <li class="nav-item @if (my_is_current_controller('posts')) active @endif">
              <a href="{{ url('posts') }}" class="nav-link">
                みんなの釣果
                @if (my_is_current_controller('posts'))
                    <span class="sr-only">(current)</span>
                @endif
              </a>
            </li>
            <li class="nav-item @if (my_is_current_controller('users')) active @endif">
              <a href="{{ url('users') }}" class="nav-link">
                ユーザー
                @if (my_is_current_controller('users'))
                    <span class="sr-only">(current)</span>
                @endif
              </a>
            </li>
          </ul>

          {{-- Navbarの右側 --}}
          <ul class="navbar-nav ml-auto">
            {{-- 投稿ボタン --}}
            <li class="nav-item">
              <a href="{{ url('posts/create') }}" id="new-post" class="btn btn-success">釣果を投稿する</a>
            </li>

            {{-- 認証関連のリンク --}}
            @guest
            {{-- 「ログイン」と「ユーザー登録」のリンク --}}
            <li class="nav-item @if (my_is_current_controller('login', 'password')) active @endif">
              <a href="{{ route('login') }}" class="nav-link">
                ログイン
                @if (my_is_current_controller('login', 'password'))
                    <span class="sr-only">(current)</span>
                @endif
              </a>
            </li>
            <li class="nav-item @if (my_is_current_controller('register')) active @endif">
              <a href="{{ route('register') }}" class="nav-link">
                ユーザー登録
                @if (my_is_current_controller('register'))
                    <span class="sr-only">(current)</span>
                @endif
              </a>
            </li>
            @else
            {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                <a href="{{ url('users/'.auth()->user()->id) }}" class="dropdown-item">
                  プロフィール
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  ログアウト
                </a>
                <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  {{-- JavaScript --}}
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>