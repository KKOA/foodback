<?php
declare(strict_types=1);

use Faker\Generator as Faker;

use App\Models\Restaurant;
// use App\Models\User;

/** @var Illuminate\Database\Eloquent\Factory $factory */

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
//    	'user_id'       => $user->id,
        'name'          =>  $faker->company,
        'description'   =>  $faker->paragraph($nbSentences = $faker->numberBetween($min = 3, $max = 8), $variableNbSentences = true),
        'address1'      =>  $faker->buildingNumber.' '.$faker->streetName,
        'address2'      =>  '',
        'city'          =>  $faker->city,
        'county'        =>  '',
        'postcode'      =>  $faker->postcode
    ];
});
