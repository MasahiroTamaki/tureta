@php
$title = '釣果を投稿する';
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <form action="{{ url('posts') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="title">題名</label>
      <input id="title" type="text" class="form-control" name="title" required autofocus>
    </div>
    <div class="form-group">
      <label for="fishing_day">釣行日</label>
      <input id="fishing_day" type="date" class="form-control" name="fishing_day" required>
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
      <input id="place" type="text" class="form-control" name="place" required>
    </div>
    <div class="form-group">
      <label for="body">記事</label>
      <textarea id="body" class="form-control" name="body" rows="8" placeholder="魚種・タックル・釣り方・状況など、自由に書き込んでください" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">投稿する</button>
  </form>
</div>
@endsection