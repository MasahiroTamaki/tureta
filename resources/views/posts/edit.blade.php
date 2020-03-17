@php
$title = '編集';
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <form action="{{ url('posts/'.$post->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">題名</label>
      <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" required autofocus>
    </div>
    <div class="form-group">
      <label for="fishing_day">釣行日</label>
      <input id="fishing_day" type="date" class="form-control" name="fishing_day" value="{{ $post->fishing_day }}" required>
    </div>
    <div class="form-group">
      <label for="weather">天気</label>
      <select class="custom-select" name="weather">
        <option selected>選択してください</option>
        <option value="晴れ">晴れ</option>
        <option value="曇り">曇り</option>
        <option value="雨">雨</option>
        <option value="雪">雪</option>
      </select>
    </div>
    <div class="form-group">
      <label for="time_zone">時間帯</label>
      <select class="custom-select" name="time_zone">
        <option selected>選択してください</option>
        <option value="朝">朝</option>
        <option value="昼">昼</option>
        <option value="夕方">夕方</option>
        <option value="夜">夜</option>
      </select>
    </div>
    <div class="form-group">
      <label for="place">場所</label>
      <input id="place" type="text" class="form-control" name="place" value="{{ $post->place }}" required>
    </div>
    <div class="form-group">
      <label for="body">記事</label>
      <textarea id="body" class="form-control" name="body" rows="8" placeholder="魚種・タックル・釣り方・状況など、自由に書き込んでください" required>{{ $post->body }}</textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection