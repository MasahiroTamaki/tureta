@php
$title = $post->title;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1 id="post-title">{{ $title }}</h1>

  {{-- 編集・削除ボタン --}}
  @can('edit', $post)  {{-- bladeによる認可 --}}
    <div class="edit">
        <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-primary">
          編集
        </a>
        @component('components.btn_del')
          @slot('controller', 'posts')
          @slot('id', $post->id)
          @slot('name', $post->title)
        @endcomponent
    </div>
  @endcan

  {{-- 記事内容 --}}
  <dl class="row">
    <dt class="col-md-2">投稿者</dt>
    <dd class="col-md-10">
      <a href="{{ url('users/'.$post->user->id) }}">
        {{ $post->user->name }}
      </a>
    </dd>
    <dt class="col-md-2">投稿日</dt>
    <dd class="col-md-10">
      <time itemprop="dateCreated" datetime="{{ $post->created_at }}">
        {{ $post->created_at }}
      </time>
    </dd>
    <dt class="col-md-2">更新日</dt>
    <dd class="col-md-10">
      <time itemprop="dateModified" datetime="{{ $post->updated_at }}">
        {{ $post->updated_at }}
      </time>
    </dd>
  </dl>
  <hr>
  <dl class="row">
    <dt class="col-md-2">釣行日</dt>
    <dd class="col-md-10">
      <time itemprop="fishing_day" datetime="{{ $post->fishing_day }}">
        {{ $post->fishing_day }}
      </time>
    </dd>
    <dt class="col-md-2">天気</dt>
    <dd class="col-md-10">{{ $post->weather }}</dd>
    <dt class="col-md-2">時間帯</dt>
    <dd class="col-md-10">{{ $post->time_zone }}</dd>
    <dt class="col-md-2">場所</dt>
    <dd class="col-md-10">{{ $post->place }}</dd>
  </dl>
  <div id="post-body">
    {{ $post->body }}
  </div>
</div>
@endsection