<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Fakerを使う
        $faker = Faker\Factory::create('ja_JP');

        //ランダムに記事を作成
        for ($i = 0; $i < 40; $i++) { 
          DB::table('posts')->insert([
            'title' => $faker->text(20),
            'fishing_day' => $faker->date(),
            'fish_type' => $faker->text(20),
            'weather' => $faker->text(20),
            'time_zone' => $faker->text(20),
            'place' => $faker->text(20),
            'body' => $faker->text(200),
            'path' => 'no_image.png',
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'user_id' => $faker->numberBetween(1, 20)
          ]);
        }
    }
}
