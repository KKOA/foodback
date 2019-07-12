<?php

use Faker\Generator as Faker;
use App\Models\Cuisine as Cuisine;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName()->unique()
    ];
});
