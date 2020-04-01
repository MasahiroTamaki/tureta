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
      <input id="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $user->name) }}" autofocus>
      @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('name') }}
        </span>
      @endif
    </div>
    <button type="submit" name="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection