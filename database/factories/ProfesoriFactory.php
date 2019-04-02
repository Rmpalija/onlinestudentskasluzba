<?php

$factory->define(App\Profesori::class, function (Faker\Generator $faker) {
    return [
        "ime" => $faker->name,
        "prezime" => $faker->name,
        "zvanje" => $faker->name,
        "status" => collect(["redovan","gostujuci","vanredni",])->random(),
    ];
});
