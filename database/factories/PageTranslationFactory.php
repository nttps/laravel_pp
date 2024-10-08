<?php

use Faker\Generator as Faker;

$factory->define(NttpsApp\Models\PageTranslation::class, function (Faker $faker) {
    return [
        'display_name' => '',
        'body_html' => '',
        'lang' => 'th',
    ];
});
$factory->define(NttpsApp\Models\PageTranslation::class, function (Faker $faker) {
    return [
        'display_name' => '',
        'body_html' => '',
        'lang' => 'en',
    ];
});

$factory->define(NttpsApp\Models\PageTranslation::class, function (Faker $faker) {
    return [
        'display_name' => '',
        'body_html' => '',
        'lang' => 'cn',
    ];
});
