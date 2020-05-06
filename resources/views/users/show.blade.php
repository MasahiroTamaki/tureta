@php
$title = 'ユーザー：' . $user->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>

  {{-- 編集・削除ボタン --}}
  {{-- 管理者のページを表示中の場合は、編集・削除のボタンを表示させない --}}
  @if (Auth::check() && !Auth::user()->isAdmin($user->id))
    @can('edit', $user)  {{-- bladeによる認可 --}}
      <div>
        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
        編集
        </a>
        @component('components.btn_del')
          @slot('controller', 'users')
          @slot('id', $user->id)
          @slot('name', $user->name)
        @endcomponent
      </div>
    @endcan
  @endif

  {{-- ユーザー1件の情報 --}}
  <dl class="row">
    <dt class="col-md-2">ID</dt>
    <dd class="col-md-10">{{ $user->id }}</dd>
    <dt class="col-md-2"><i class="far fa-user-circle"></i> ユーザー名</dt>
    <dd class="col-md-10">{{ $user->name }}</dd>
    <dt class="col-md-2"><i class="far fa-envelope"></i> メールアドレス</dt>
    <dd class="col-md-10">{{ $user->email }}</dd>
  </dl>

  {{-- ユーザーの記事一覧 --}}
  <h2>投稿した釣果</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><i class="far fa-sticky-note"></i> 題名</th>
          <th><i class="far fa-calendar-alt"></i> 釣行日</th>
          <th><i class="fas fa-fish"></i> 魚種</th>
          <th>投稿日</th>
          <th>更新日</th>

          {{-- 記事の編集・削除ボタンのカラム --}}
          @can('edit', $user) <th></th> @endcan
        </tr>
      </thead>
      <tbody>
        @foreach ($user->posts as $post)
          <tr>
            <td>
              <a href="{{ url('posts/'.$post->id) }}">
                {{ $post->title }}
              </a>
            </td>
            <td>{{ $post->fishing_day }}</td>
            <td>{{ $post->fish_type }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            @can('edit', $user)  {{-- 認可 --}}
              <td nowrap>
                <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-primary">
                  編集
                </a>
                @component('components.btn_del')
                  @slot('controller', 'posts')
                  @slot('id', $post->id)
                  @slot('name', $post->title)
                @endcomponent
              </td>
            @endcan
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $user->posts->links() }}
</div>
@endsection