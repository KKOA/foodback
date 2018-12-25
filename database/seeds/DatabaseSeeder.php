<?php

use Illuminate\Database\Seeder;
use App\Cuisine as Cuisine;
use App\Restaurant as Restaurant;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CuisineSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(ReviewSeeder::class);

        $faker = Faker\Factory::create();

        $restaurants = Restaurant::all();
        $cuisines = Cuisine::all()->pluck('id')->toArray();
        
        foreach($restaurants as $restaurant)
        {
            $restaurant->cuisines()->detach();
            $randomNumber = $faker->numberBetween($min = 0, $max = 4);
            $restaurant->cuisines()->attach($faker->randomElements((array) $cuisines, $count = $randomNumber));
        }
    }
}
