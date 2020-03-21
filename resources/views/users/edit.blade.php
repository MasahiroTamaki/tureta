@php
$title = '編集：'.$user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <form method="POST" action="{{ url('users/'.$user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">ユーザー名</label>
      <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection