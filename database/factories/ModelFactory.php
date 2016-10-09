<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Access\User\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Backend\News\News::class, function ($faker) {
    return [
        'slug' => $faker->slug,
        'user_id' => 1,
        'title' => $faker->words(3, true),
        'subtitle' => $faker->words(3, true),
        'content' => $faker->text(),
        'hits' => $faker->randomNumber(3),
        'comments' => $faker->randomNumber(3),
        'status' => $faker->numberBetween(0, 3),
        'published_at' => Carbon\Carbon::now()
    ];
});

$factory->define(App\Models\Backend\Tags\Tag::class, function ($faker) {
    return [
        'name' => $faker->words(1, true),
    ];
});
