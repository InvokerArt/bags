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

/**
 * 填充数据例子
 * factory(App\Models\Access\User\User::class,200)->create()->each(function($user){
 *     $user->news()->saveMany(factory(App\Models\Backend\News\News::class,3)->make())->each(function($news){
 *         $news->categories()->save(factory(App\Models\Backend\News\CategoriesNews)->make());
 *         $news->tags()->saveMany(factory(App\Models\Backend\Tags\Tag::class,3)->make());
 *         $news->comments()->saveMany(factory(App\Models\Backend\Comments\Comment::class,3)->make());
 *     });
 * });
 */

$factory->define(App\Models\Access\User\User::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\zh_CN\phoneNumber($faker));
    return [
        'mobile' => $faker->phoneNumber(),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Backend\News\News::class, function ($faker) {
    $image = str_replace('storage/app/public/image\\', '/storage/image', $faker->image('storage/app/public/image', '100', '100', 'cats'));
    return [
        'slug' => $faker->slug,
        'user_id' => factory(App\Models\Access\User\User::class)->create()->id,
        'title' => $faker->words(3, true),
        'image' => $image,
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

$factory->define(App\Models\Backend\Comments\Comment::class, function ($faker) {
    return [
        'user_id' => factory(App\Models\Access\User\User::class)->create()->id,
        'commentable_id' => factory(App\Models\Backend\News\News::class)->create()->id,
        'commentable_type' => 'App\Models\Backend\News\News',
        'body' => $faker->text(),
        'status' => $faker->numberBetween(0, 3),
    ];
});
