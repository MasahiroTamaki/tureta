<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;  // Userモデルをインポート
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    /**
     * 各アクションの前に実行させるミドルウェア
     */
    public function __construct()
    {
      // $this->middleware('auth')->except(['index', 'show']);
      // 登録していなくても、退会だけはできるようにする
      $this->middleware('auth')->only('destroy');
      $this->middleware('verified')->except(['index', 'show', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ユーザーの一覧表示
    public function index()
    {
      $users = User::paginate(5);  //すべてのユーザーを5件ずつ表示
      return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ユーザー1件詳細表示
    public function show(User $user)
    {
      // そのユーザーが投稿した記事のうち、最新5件を取得
      $user->posts = $user->posts()->paginate(5);
      return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 更新用フォームへ移動
    public function edit(User $user)
    {
      $this->authorize('edit', $user);  // 認可を判断するpolisyのeditメソッド
      return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    // 実際の更新処理
    public function update(Request $request, User $user)
    {
      $this->authorize('edit', $user);  // 認可を判断するpolisyのeditメソッド

      // name欄だけ検査のため元のStoreUserクラス内のバリデーションルールからname欄のルールだけ取り出す。
      $request->validate([
        'name' => (new StoreUser())->rules()['name']
      ]);

      $user->name = $request->name;
      $user->save();
      // 完了後、更新したユーザーページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('users/'.$user->id)->with('my_status', 'プロフィールを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 1件削除
    public function destroy(User $user)
    {
      $this->authorize('edit', $user);  // 認可を判断するpolisyのeditメソッド
      $user->delete();
      // 完了後、ユーザー一覧ページへ移動。フラッシュメッセージをsessionに保存。
      return redirect('users')->with('my_status', 'ユーザーを削除しました。');
    }
}
