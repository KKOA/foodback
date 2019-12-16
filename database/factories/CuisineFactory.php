<?php
declare(strict_types=1);

use Faker\Generator as Faker;
use App\Models\Cuisine as Cuisine;

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Cuisine::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName(),
    ];
});
