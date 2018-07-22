<?php

use Faker\Generator as Faker;
Use Carbon\Carbon as Carbon;
use App\Restaurant as Restaurant;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'          =>  $faker->company,
        'description'   =>  $faker->paragraph($nbSentences = $faker->numberBetween($min = 3, $max = 8), $variableNbSentences = true),
        'address1'      =>  $faker->buildingNumber.' '.$faker->streetName,
        'address2'      =>  '',
        'city'          =>  $faker->city,
        'county'        =>  '',
        'postcode'      =>  $faker->postcode
    ];
});
