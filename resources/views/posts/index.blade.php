@php
$title = 'みんなの釣果';
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card list-hover" style="margin-bottom: 20px">
          <img class="card-img-top" src="{{ asset('storage/' . $post->path) }}" style="width: 100%; height: 200px; object-fit: cover;">
          <a href="{{ url('posts/'.$post->id) }}"></a>
          <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text"><i class="far fa-calendar-alt"></i> {{ $post->fishing_day }}</p>
            <p class="card-text"><i class="fas fa-fish"></i> {{ $post->fish_type }}</p>
            <p class="card-text"><i class="far fa-user-circle"></i> {{ $post->user->name }}</p>
            <a href="{{ url('posts/' . $post->id) }}" class="btn btn-primary">詳しく見る</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    {{ $posts->links() }}
  </div>
</div>
@endsection