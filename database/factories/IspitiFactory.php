<?php

$factory->define(App\Ispiti::class, function (Faker\Generator $faker) {
    return [
        "kalendarski_naziv" => $faker->name,
        "profesor_id" => factory('App\Profesori')->create(),
        "predmet_id" => factory('App\Predmeti')->create(),
        "datum_izvrsavanja" => $faker->date("d-m-Y H:i:s", $max = 'now'),
    ];
});
