<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomPasswordReset;
use Illuminate\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *リレーション (1対多の関係)
     */
    public function posts()  //複数形
    {
      // 記事を新しい順で取得する
      return $this->hasMany('App\Post')->latest();
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * パスワードリセット通知の送信
     * 
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
      $this->notify(new CustomPasswordReset($token));
    }

    /**
     * メール確認通知の送信
     * 
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
      $this->notify(new CustomVerifyEmail());
    }

    /**
     * 現在のユーザー、または引数で渡されたIDかどうかを返す
     * 
     * @param number $id User ID
     * @return booliean
     */
    public function isAdmin($id = null) {
      $id = ($id) ? $id : $this->id;
      return $id == config('admin_id');
    }
}
