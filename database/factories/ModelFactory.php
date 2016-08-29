<?php

use JeroenNoten\LaravelPages\Models\Page;
use JeroenNoten\LaravelPages\Models\View;

$factory->define(Page::class, function (Faker\Generator $faker) {
    return [
        'uri' => $faker->word,
        'view_id' => function () {
            return factory(View::class)->create()->id;
        }
    ];
});

$factory->define(View::class, function (Faker\Generator $faker) {
    return [
        'layout' => 'layouts.app'
    ];
});
