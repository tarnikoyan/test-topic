<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Topic;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'text' => $faker->text,
        'author_id' => User::inRandomOrder()->first()->id,
        'topic_id' => Topic::inRandomOrder()->first()->id,
    ];
});
