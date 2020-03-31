<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 管理者にはすべての行動を認可する。
     * 
     * @param $user
     * @param $ability
     * @return mixed
     */
    public function before($user, $ability)
    {
      return $user->isAdmin() ? true : null;
    }

    /**
     * 編集と削除の認可を判断する。
     * 
     * @param \App\User $user 現在ログインしているユーザー
     * @param \App\User $model 現在表示しているプロフィールページのユーザー
     * return mixed
     */
    public function edit(user $user, User $model)
    {
      return $user->id == $model->id;
    }
}
