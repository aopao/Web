<?php

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

$factory->define(App\Models\Agent::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'mobile' => '18978199938',
        'password' => $password ?: $password = bcrypt('admin'),
        'nickname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
    ];
});
