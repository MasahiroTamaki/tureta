<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PracticeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
      // レコード新規作成
      $user = new \App\User;
      $user->name = "テスト太郎";
      $user->email = "taro@test.com";
      $user->password = \Hash::make('test_password');
      $user->save();

      // SELECT
      $readUser = \App\User::Where('name','テスト太郎')->first();
      $this->assertNotNull($readUser); // データが取得できたかテスト
      $this->assertTrue(\Hash::check('test_password', $readUser->password));

      // レコード削除
      \App\User::where('email', 'taro@test.com')->delete();
    }


}
