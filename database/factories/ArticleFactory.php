<?php

use App\User;
use App\Topic;
use App\Article;
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

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'topic_id' =>  function(){
            return factory(Topic::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'body' => $faker->paragraph,
        'views' => rand(0, 4500)
    ];
});
