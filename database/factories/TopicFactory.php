<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use App\User;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'owner_id' => User::inRandomOrder()->first()->id
    ];
});
