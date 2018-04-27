<?php

use Illuminate\Database\Seeder;
use App\Review as Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $review1 = Review::firstOrCreate(
            ['id'=>'1','restaurant_id'=>'1'], //Greek
            [
                'restaurant_id' =>  1,
                'comment'       => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'rating'        =>  4
            ]
        );
        $review2 = Review::firstOrCreate(
            ['id'=>'2','restaurant_id'=>'1'], //Greek
            [
                'restaurant_id' =>  1,
                'comment'       => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'rating'        =>  3
            ]
        );
        $review3 = Review::firstOrCreate(
            ['id'=>'3','restaurant_id'=>'2'], //Greek
            [
                'restaurant_id' =>  2,
                'comment'       => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'rating'        =>  5
            ]
        );
    }
}
