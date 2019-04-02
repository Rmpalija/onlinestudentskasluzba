<?php

$factory->define(App\Predmeti::class, function (Faker\Generator $faker) {
    return [
        "naziv" => $faker->name,
        "profesor_id" => factory('App\User')->create(),
        "semestar" => $faker->randomNumber(2),
    ];
});
