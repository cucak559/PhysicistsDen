<?php

use App\User;
use App\Article;
use App\Comment;
use App\Dislike;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'body' => $faker->paragraph,
        'commentable_id' => function(){
            return factory(Article::class)->create()->id;
        },
        'commentable_type' => Article::class

    ];
});
