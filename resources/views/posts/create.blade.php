@php
$title = '釣果を投稿する';
@endphp
@extends('layouts.my')
@section('content')
<div class="container" style="max-width: 728px; margin: 0 auto;">
  <h1>{{ $title }}</h1>
  <form action="{{ url('posts') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title" class="far fa-sticky-note"> 題名</label>
      <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name="title" value="{{ old('title') }}" autofocus>
      @if ($errors->has('title'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('title') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="fishing_day" class="far fa-calendar-alt"> 釣行日</label>
      <input id="fishing_day" type="date" class="form-control @if ($errors->has('fishing_day')) is-invalid @endif" name="fishing_day" value="{{ old('fishing_day') }}">
      @if ($errors->has('fishing_day'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('fishing_day') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="fish_type" class="fas fa-fish"> 魚種</label>
      <input id="fish_type" type="text" class="form-control @if ($errors->has('fish_type')) is-invalid @endif" name="fish_type" value="{{ old('fish_type') }}">
      @if ($errors->has('fish_type'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('fish_type') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="weather" class="far fa-sun"> 天気</label>
      <select class="custom-select @if ($errors->has('weather')) is-invalid @endif" name="weather">
        <option value="">選択してください</option>
        <option value="晴れ" @if(old('weather')=='晴れ') selected  @endif>晴れ</option>
        <option value="曇り" @if(old('weather')=='曇り') selected  @endif>曇り</option>
        <option value="雨" @if(old('weather')=='雨') selected  @endif>雨</option>
        <option value="雪" @if(old('weather')=='雪') selected @endif>雪</option>
      </select>
      @if ($errors->has('weather'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('weather') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="time_zone" class="far fa-clock"> 時間帯</label>
      <select class="custom-select @if ($errors->has('time_zone')) is-invalid @endif" name="time_zone">
        <option value="">選択してください</option>
        <option value="朝" @if(old('time_zone')=='朝') selected @endif>朝</option>
        <option value="昼" @if(old('time_zone')=='昼') selected @endif>昼</option>
        <option value="夕方" @if(old('time_zone')=='夕方') selected @endif>夕方</option>
        <option value="夜" @if(old('time_zone')=='夜') selected @endif>夜</option>
      </select>
      @if ($errors->has('time_zone'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('time_zone') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="place" class="fas fa-map-marker-alt"> 場所</label>
      <input id="place" type="text" class="form-control @if ($errors->has('place')) is-invalid @endif" name="place" value="{{ old('place') }}">
      @if ($errors->has('place'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('place') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="body" class="far fa-edit"> 記事</label>
      <textarea id="body" class="form-control @if ($errors->has('body')) is-invalid @endif" name="body" rows="8" placeholder="タックル・釣り方・状況など、自由に書き込んでください">{{ old('body') }}</textarea>
      @if ($errors->has('body'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('body') }}
      </span>
      @endif
    </div>
    <div class="form-group">
      <label for="photo" class="far fa-image"> 画像</label>
      <input type="file" class="form-control-file @if ($errors->has('photo')) is-invalid @endif" name="photo">
      @if ($errors->has('photo'))
      <span class="invalid-feedback" role="alert">
        {{ $errors->first('photo') }}
      </span>
      @endif
    </div>
    <button type="submit" name="submit" class="btn btn-primary">投稿する</button>
  </form>
</div>
@endsection