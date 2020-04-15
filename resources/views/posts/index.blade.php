@php
$title = 'みんなの釣果';
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>投稿者</th>
          <th>題名</th>
          <th></th>
          <th>本文</th>
          <th>投稿日</th>
          <th>更新日</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>
            <a href="{{ url('users/'.$post->user->id) }}">{{ $post->user->name }}</a>
          </td>
          <td>
            <a href="{{ url('posts/'.$post->id) }}">{{ $post->title }}</a>
          </td>
          <td><img src="{{ asset('storage/' . $post->path) }}" width="40%"></td>
          <td>{{ $post->body }}</td>
          <td>{{ $post->created_at }}</td>
          <td>{{ $post->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </<img>
  {{ $posts->links() }}
</div>
@endsection