<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'mark' => random_int(1, 5),
        'article_id' => Article::inRandomOrder()->first()->id,
        'author_id' => User::inRandomOrder()->first()->id,
    ];
});
