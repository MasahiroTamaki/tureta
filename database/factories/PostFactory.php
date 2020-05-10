<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker->text(20),
      'fishing_day' => $faker->date("Ymd"),
      'fish_type' => $faker->text(20),
      'weather' => $faker->randomElement(['晴れ', '曇り', '雨', '雪']),
      'time_zone' => $faker->randomElement(['朝', '昼', '夕方', '夜']),
      'place' => $faker->text(20),
      'body' => $faker->text(200),
      'path' => 'no_image.png',
    ];
});
