<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;  // Postモデルをインポート
use App\User;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * 各アクションの前に実行させるミドルウェア
     */
    public function __construct()
    {
      // $this->middleware('auth')->except(['index', 'show']);
      $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 一覧表示
    public function index()
    {
      // 釣行日の新しい順で記事を8件ずつ一覧表示
      $posts = Post::orderByDesc('fishing_day')->paginate(8);  //latest(), oldest() デフォルトでcreated_atカラムによりソートされる。

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
     * @param  App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    // 実際の投稿処理
    public function store(StorePost $request)
    {
      $post = new Post;                          //新しいインスタンスを作成
      
      if(!empty($request->file('photo'))){
        // ログインしているユーザーを取得
        $user = Auth::user();
        // ファイル名取得
        $filename = $user->id . $request->file('photo')->getClientOriginalName();
        // storage/app/publicにファイルを保存する
        $request->file('photo')->storeAs('public', $filename);
        $post->path = $filename;
      }
      
      $post->title = $request->title;            //それぞれの値を保存して
      $post->fishing_day = $request->fishing_day;
      $post->fish_type = $request->fish_type;
      $post->weather = $request->weather;
      $post->time_zone = $request->time_zone;
      $post->place = $request->place;
      $post->body = $request->body;
      $post->user_id = $request->user()->id;     // $request->user()は認証済みのユーザーを返す
      $post->save();                             //DBに保存
      // 完了後、投稿した記事のページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('posts/'.$post->id)->with('my_status', '記事を投稿しました。');
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
    //更新用フォームへ移動
    public function edit(Post $post)
    {
      $this->authorize('edit', $post);  // 認可を判断するpolisyのeditメソッド
      return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StorePost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 実際の更新処理
    public function update(StorePost $request, Post $post)
    {
      $this->authorize('edit', $post);  // 認可を判断するpolisyのeditメソッド
      
      if(!empty($request->file('photo'))){

        if($post->path !== 'no_image.png'){
          // 投稿済みの画像ファイルの削除
          $deleteFile = 'public/' . $post->path;
          Storage::delete($deleteFile);
        }
        // ファイル名取得
        $filename = $post->user_id . $request->file('photo')->getClientOriginalName();
        // storage/app/publicにファイルを保存する
        $request->file('photo')->storeAs('public', $filename);
        $post->path = $filename;
      }

      $post->title = $request->title;            //それぞれの値を保存して
      $post->fishing_day = $request->fishing_day;
      $post->fish_type = $request->fish_type;
      $post->weather = $request->weather;
      $post->time_zone = $request->time_zone;
      $post->place = $request->place;
      $post->body = $request->body;
      $post->save();                             //DBに保存
      //完了後、更新した記事のページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('posts/'.$post->id)->with('my_status', '記事を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 1件削除
    public function destroy(Post $post)
    {
      $this->authorize('edit', $post);  // 認可を判断するpolisyのeditメソッド

      if($post->path !== 'no_image.png'){
        // 画像がある場所のパスを指定し、画像ファイルの削除
        $deleteFile = 'public/' . $post->path;
        Storage::delete($deleteFile);
      }

      $post->delete();
      // 完了後、一覧ページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('posts')->with('my_status', '記事を削除しました。');
    }
}
