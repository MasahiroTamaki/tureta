@php
$title = env('APP_NAME');
@endphp

@extends('layouts.my')
@section('title', 'tureta')
@section('content')
<div class="jumbotron" style="background:url(images/top.jpg); background-size:cover;">
  <div class="container">
    <h1>{{ $title }}</h1>
    <p>
      釣果投稿×SNSサイトです
    </p>
    <p>
      <a href="#" id="register" class="btn btn btn-outline-light">ユーザー登録する</a>
    </p>
    <p>
      <a href="#" id="posts" class="btn btn btn-outline-light">みんなのを投稿をみる</a>
    </p>
  </div>
</div>
@endsection