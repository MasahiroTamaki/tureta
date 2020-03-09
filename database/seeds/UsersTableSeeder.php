<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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

        //固定ユーザー作成
        DB::table('users')->insert([
          'name' => 'turikichi',
          'email' => 'kichi4435@gmail.com',
          'password' => bcrypt('1234'),
          'email_verified_at' => $faker->dateTime(),
          'created_at' => $faker->dateTime(),
          'updated_at' => $faker->dateTime(),
        ]);
        DB::table('users')->insert([
          'name' => 'hoge1',
          'email' => 'hoge1@hoge.com',
          'password' => bcrypt('1234'),
          'email_verified_at' => $faker->dateTime(),
          'created_at' => $faker->dateTime(),
          'updated_at' => $faker->dateTime(),
        ]);

        //ランダムにユーザー作成
        for ($i=0; $i < 18; $i++) { 
          DB::table('users')->insert([
            'name' => $faker->unique()->userName(),
            'email' => $faker->unique()->email(),
            'password' => bcrypt('1234'),
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);
        }
    }
}
