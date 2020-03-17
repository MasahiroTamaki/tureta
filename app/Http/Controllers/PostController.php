<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;  // Postモデルをインポート

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 一覧表示
    public function index()
    {
      // 投稿日の新しい順で記事を一覧表示
      $posts = Post::latest()->get();  //latest(), oldest() デフォルトでcreated_atカラムによりソートされる。

      return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 新規投稿用フォームへ移動
    public function create()
    {
      return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 実際の投稿処理
    public function store(Request $request)
    {
      $post = new Post;                          //新しいインスタンスを作成
      $post->title = $request->title;            //それぞれの値を保存して
      $post->fishing_day = $request->fishing_day;
      $post->weather = $request->weather;
      $post->time_zone = $request->time_zone;
      $post->place = $request->place;
      $post->body = $request->body;
      $post->save();                             //DBに保存
      return redirect('posts/'.$post->id);       // 完了後、投稿した記事のページへ移動
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //1件ごとの詳細表示
    public function show(Post $post)
    {
      return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
