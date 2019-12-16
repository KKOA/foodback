<?php
declare(strict_types=1);

use Faker\Generator as Faker;
Use Carbon\Carbon as Carbon;

use App\Models\Restaurant as Restaurant;
use App\Models\Review as Review;

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


$factory->define(Review::class, function (Faker $faker) {
    return [
        'comment'       =>  $faker->paragraph($nbSentences = $faker->numberBetween($min=3, $max=8), $variableNbSentences = true),
        'rating'        =>  $faker->numberBetween($min=0, $max=5),
        'updated_at'    =>  Carbon::now()->subMinutes($faker->numberBetween($min=0, $max=200))
    ];
});
