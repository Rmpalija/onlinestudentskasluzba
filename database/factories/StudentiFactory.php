<?php

$factory->define(App\Studenti::class, function (Faker\Generator $faker) {
    return [
        "ime" => $faker->name,
        "prezime" => $faker->name,
        "jmb" => $faker->name,
        "index" => $faker->name,
        "status" => collect(["redovan","vanredan",])->random(),
        "fakultet_id" => factory('App\Fakulteti')->create(),
    ];
});
