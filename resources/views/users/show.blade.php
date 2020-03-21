@php
$title = 'ユーザー：' . $user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>

  {{-- 編集・削除ボタン --}}
  <div>
    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
    編集
    </a>
    @component('components.btn_del')
      @slot('table', 'users')
      @slot('id', $user->id)
    @endcomponent
  </div>

  {{-- ユーザー1件の情報 --}}
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