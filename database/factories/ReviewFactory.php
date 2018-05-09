<?php

use Faker\Generator as Faker;
Use Carbon\Carbon as Carbon;

use App\Restaurant as Restaurant;
use App\Review as Review;

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

    $restaurants = Restaurant::all()->pluck('id')->toArray();//
    array_shift ( $restaurants );// Remove the first entry
    
    return [
        'restaurant_id' =>  $faker->randomElement($restaurants),
        'comment'       =>  $faker->paragraph($nbSentences = $faker->numberBetween($min=3, $max=8), $variableNbSentences = true),
        'rating'        =>  $faker->numberBetween($min=0, $max=5),
        'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
    ];
});
