<?php

$factory->define(App\Fakulteti::class, function (Faker\Generator $faker) {
    return [
        "naziv" => $faker->name,
    ];
});
