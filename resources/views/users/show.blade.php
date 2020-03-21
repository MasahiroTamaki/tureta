@php
$title = 'ユーザー：' . $user->name;
@endphp
@extends('layouts.my')

@section('content')
<div class="container">
  <h1>{{ $title }}</h1>

  <dl class="row">
    <dt class="col-md-2">ID</dt>
    <dd class="col-md-10">{{ $user->id }}</dd>
    <dt class="col-md-2">ユーザー名</dt>
    <dd class="col-md-10">{{ $user->name }}</dd>
    <dt class="col-md-2">メールアドレス</dt>
    <dd class="col-md-10">{{ $user->email }}</dd>
  </dl>
</div>
@endsection