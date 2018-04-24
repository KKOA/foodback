<?php

use Illuminate\Database\Seeder;
use App\Restaurant as Restaurant;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantImg = '/imgs/restaurants/';
        $faker = Faker\Factory::create();
        $restaurant1 = Restaurant::firstOrCreate(
            ['name'=>'El Greco'], //Greek
            [
                'name'          =>  'El Greco',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
            ]
        );
        $restaurant2 = Restaurant::firstOrCreate(
            ['name'=>'Reubens'], //Russina
            [
                'name'          =>  'Reubens',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)

            ]
        );
        $restaurant3 = Restaurant::firstOrCreate(
            ['name'=>'Laduree UK'], //Swedish
            [
                'name'          =>  'Laduree UK',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant4 = Restaurant::firstOrCreate(
            ['name'=>'Sorrentino Restaurant'], //Italien
            [
                'name'          =>  'Sorrentino Restaurant',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant5 = Restaurant::firstOrCreate(
            ['name'=>'Makara'], //Turkish
            [
                'name'          =>  'Makara',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant6 = Restaurant::firstOrCreate(
            ['name'=>'Tenkaichi'], //Japanense
            [
                'name'          =>  'Tenkaichi',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant7 = Restaurant::firstOrCreate(
            ['name'=>'Bear & Billet'],//German
            [
                'name'          =>  'Bear & Billet',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant8 = Restaurant::firstOrCreate(
            ['name'=>'Akamba'], //African
            [
                'name'          =>  'Akamba',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant9 = Restaurant::firstOrCreate(
            ['name'=>'Bistro Jacques'],//French
            [
                'name'          =>  'Bistro Jacques',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant10 = Restaurant::firstOrCreate( //American
            ['name'=>'Infamous Diner'],
            [
                'name'          =>  'Infamous Diner',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant11 = Restaurant::firstOrCreate(
            ['name'=>'Los Gatos'], //Spanish
            [
                'name'          =>  'Los Gatos',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant12 = Restaurant::firstOrCreate(
            ['name'=>'Nur'], //Egyptian
            [
                'name'          =>  'Nur',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant13 = Restaurant::firstOrCreate(
            ['name'=>'Thai Garden'], //Thai
            [
                'name'          =>  'Thai Garden',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant14 = Restaurant::firstOrCreate(
            ['name'=>'Amigos Mexican Restaurant'], //Mexican
            [
                'name'          =>  'Amigos Mexican Restaurant',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
        $restaurant15 = Restaurant::firstOrCreate(
            ['name'=>'Lebaneat'], //Lebanese
            [
                'name'          =>  'Lebaneat',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]
        );
    }
}
