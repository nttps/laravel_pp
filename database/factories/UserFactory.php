<?php

use NttpsApp\User;
use Illuminate\Support\Str;
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


//Admin User Factory
$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'email' => 'admin@email.com',
        'password' => bcrypt('123456'), // secret
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
