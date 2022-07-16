<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->afterCreating(App\Author::class, function ($author, $faker) {
    $author->profile()->save(\App\Models\Profile::factory()->make());
});