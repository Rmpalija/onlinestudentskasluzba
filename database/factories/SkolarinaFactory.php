<?php

$factory->define(App\Skolarina::class, function (Faker\Generator $faker) {
    return [
        "student_id" => factory('App\Studenti')->create(),
        "semestar" => $faker->randomNumber(2),
        "uplata" => $faker->randomNumber(2),
    ];
});
