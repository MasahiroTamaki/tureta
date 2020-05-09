<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class LoginTest extends DuskTestCase
{
    // dusk実行前にマイグレーションする
    use DatabaseMigrations;

    /**
     * ログイン機能テストをする
     *
     * @return void
     */
    public function testLogin()
    {
        // ユーザーを作成しておく
        $user = factory(User::class)->create([
          'email' => 'dusk@foo.com',
          'password' => bcrypt('1234'),
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login') // ログインページへ移動
                    ->type('email', $user->email) // メールアドレスを入力
                    ->type('password', '1234') // パスワードを入力
                    ->press('ログイン') // 送信ボタンをクリック
                    ->assertPathIs('/laravel/tureta/public/users/'.$user->id);  // プロフィールページへ移動していることを確認
        });
    }
}
