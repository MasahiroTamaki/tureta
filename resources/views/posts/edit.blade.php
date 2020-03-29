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
      <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name="title" value="{{ old('title', $post->title) }}" autofocus>
      @if ($errors->has('title'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('title') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="fishing_day">釣行日</label>
      <input id="fishing_day" type="date" class="form-control  @if ($errors->has('fishing_day')) is-invalid @endif" name="fishing_day" value="{{ old('fishing_day', $post->fishing_day) }}">
      @if ($errors->has('fishing_day'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('fishing_day') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="weather">天気</label>
      <select class="custom-select @if ($errors->has('weather')) is-invalid @endif" name="weather">
        <option value="">選択してください</option>
        <option value="晴れ" @if(old('weather', "$post->weather")=='晴れ') selected @endif>晴れ</option>
        <option value="曇り" @if(old('weather', "$post->weather")=='曇り') selected @endif>曇り</option>
        <option value="雨" @if(old('weather', "$post->weather")=='雨') selected @endif>雨</option>
        <option value="雪" @if(old('weather', "$post->weather")=='雪') selected @endif>雪</option>
      </select>
      @if ($errors->has('weather'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('weather') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="time_zone">時間帯</label>
      <select class="custom-select @if ($errors->has('time_zone')) is-invalid @endif" name="time_zone">
        <option value="">選択してください</option>
        <option value="朝" @if(old('time_zone', "$post->time_zone")=='朝') selected @endif>朝</option>
        <option value="昼" @if(old('time_zone', "$post->time_zone")=='昼') selected @endif>昼</option>
        <option value="夕方" @if(old('time_zone', "$post->time_zone")=='夕方') selected @endif>夕方</option>
        <option value="夜" @if(old('time_zone', "$post->time_zone")=='夜') selected @endif>夜</option>
      </select>
      @if ($errors->has('time_zone'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('time_zone') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="place">場所</label>
      <input id="place" type="text" class="form-control @if ($errors->has('place')) is-invalid @endif" name="place" value="{{ old('place', $post->place) }}">
      @if ($errors->has('place'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('place') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="body">記事</label>
      <textarea id="body" class="form-control @if ($errors->has('body')) is-invalid @endif" name="body" rows="8" placeholder="魚種・タックル・釣り方・状況など、自由に書き込んでください">{{ old('body', $post->body) }}</textarea>
      @if ($errors->has('body'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('body') }}
      </span>
      @endif
    </div>
    <button type="submit" name="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection