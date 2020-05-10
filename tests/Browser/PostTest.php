<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\DatePicker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Post;

/**
 * Post(記事)に関するテスト
 */
class PostTest extends DuskTestCase
{
    // Dusk実行前にマイグレーションする
    use DatabaseMigrations;
    /**
     * 記事に関する操作(作成、編集、削除)のテスト
     *
     * @return void
     */
    public function testCRUD()
    {
        // ユーザーを作成
        $user = factory(User::class)->create();

        
        // 投稿する内容
        $post = factory(Post::class)->make([
          'id' => 1,
          'user_id' => '$user->id' // 上で作成したユーザーを投稿者とする
          ]);
          
          // 編集する内容
          $update = factory(Post::class)->make();
          
          $this->browse(function (Browser $browser) use ($user, $post, $update) {
            $today = now();
            $browser->loginAs($user)
                    ->visit('/')
                    
                    // 投稿
                    ->press('#new-post') // 「釣果を投稿する」ボタンを押す
                    ->assertPathIs('/laravel/tureta/public/posts/create') // 投稿ページであることを確認
                    ->type('title', $post->title) // 題名を入力
                    ->keys('#fishing_day', $post->fishing_day) // 釣行日を入力
                    ->type('fish_type', $post->fish_type) // 魚種を入力
                    ->select('weather', $post->weather) // 天気を入力
                    ->select('time_zone', $post->time_zone) // 時間帯を入力
                    ->type('place', $post->place) // 場所を入力
                    ->type('body', $post->body) // 本文を入力
                    ->press('投稿する') // 投稿する
                    ->assertPathIs('/laravel/tureta/public/posts/'.$post->id) // 記事ページであることを確認
                    ->assertSeeIn('#post-title', $post->title) // 題名を確認
                    // ->assertSeeIn('#post-fishig_day', $post->fishing_day) // 釣行日を確認
                    ->assertSeeIn('#post-fish_type', $post->fish_type) // 魚種を確認
                    ->assertSeeIn('#post-weather', $post->weather) // 天気を確認
                    ->assertSeeIn('#post-time_zone', $post->time_zone) // 時間帯を確認
                    ->assertSeeIn('#post-place', $post->place) // 場所を確認
                    ->assertSeeIn('#post-body', $post->body) // 本文を確認

                    // 編集
                    ->press('.edit .btn-primary')
                    ->assertPathIs('/laravel/tureta/public/posts/'.$post->id.'/edit')
                    ->type('title', $update->title)
                    ->type('body', $update->body)
                    ->press('[type="submit"]')
                    ->assertPathIs('/laravel/tureta/public/posts/'.$post->id)
                    ->assertSeeIn('#post-title', $update->title)
                    ->assertSeeIn('#post-body', $update->body)

                    // 削除
                    ->press('削除') // 「削除」ボタンを押す
                    ->whenAvailable('.modal', function ($modal) { // モーダルが表示されるまで待つ
                        $modal->press('.modal-footer .btn-danger') // モーダル内の「削除」ボタンを押す
                              ->assertPathIs('/laravel/tureta/public/posts'); // 一覧ページであることを確認
                    });
        });
    }
}