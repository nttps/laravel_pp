<?php

use Faker\Generator as Faker;

$factory->define(NttpDev\Model\Role::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'display_name' => 'ADMIN',
    ];
});


$factory->define(NttpDev\Model\Role::class, function (Faker $faker) {
    return [
        'name' => 'user',
        'display_name' => 'User',
    ];
});

