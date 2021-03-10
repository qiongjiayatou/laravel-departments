<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(50),
        'description' => $faker->realText(),
        // 'logo' => 'https://placeimg.com/100/100/any?' . rand(1, 100)
        'logo' => 'pic-' . rand(1, 8) . '.svg'
    ];
});
