@php
$title = env('APP_NAME');
@endphp

@extends('layouts.my')
@section('title', 'tureta')
@section('content')
<div class="jumbotron">
  <div class="container">
      <h1><img src="{{ asset('images/iconlg.png') }}" alt="icon">&nbsp;{{ $title }}</h1>
      <body id="top-body">
        <p>釣り人のための釣果情報共有サイトです。</p>
        <p>釣果は誰でも見れます。</p>
        <p>記事の投稿・編集・削除にはユーザー登録が必要です。</p>
        <p>ゲストユーザー</p>
        <p>メールアドレス: guest@mail.com</p>
        <p>パスワード: guest</p>
        <p>
          <a href="{{ url('posts') }}" id="posts" class="btn btn btn-outline-light">みんなの投稿をみる</a>
        </p>
        <p>
          <a href="{{ route('login') }}" id="login" class="btn btn btn-outline-light">ログインする</a>
        </p>
        <p>
          <a href="{{ route('register') }}" id="register" class="btn btn btn-outline-light">ユーザー登録する</a>
        </p>
      </body>
    </div>
</div>
@endsection