<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faq\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(rand(5, 10)),
        'answer' => $faker->paragraph(),
        'order' => rand(1, 10),
        'active' => 1,
    ];
});
