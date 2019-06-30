<?php
declare(strict_types=1);

//Models
use App\Models\Cuisine;
use App\Models\Restaurant;

use Illuminate\Database\Seeder;
use Faker\Factory;


/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CuisineSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(ReviewSeeder::class);

        $faker = Factory::create();

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
