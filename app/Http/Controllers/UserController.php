<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;  // Userモデルをインポート
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
      return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 実際の更新処理
    public function update(Request $request, User $user)
    {
      $user->name = $request->name;
      $user->save();
      return redirect('users/'.$user->id);
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
      $user->delete();
      return redirect('users');
    }
}
