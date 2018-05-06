<?php

use Illuminate\Database\Seeder;
Use Carbon\Carbon as Carbon;

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
        $review = factory(Review::class,50)->create();
        // $review1 = Review::firstOrCreate(
        //     ['id'=>'1','restaurant_id'=>'1'], //Greek
        //     [
        //         'restaurant_id' =>  1,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review2 = Review::firstOrCreate(
        //     ['id'=>'2','restaurant_id'=>'1'], //Greek
        //     [
        //         'restaurant_id' =>  1,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review3 = Review::firstOrCreate(
        //     ['id'=>'3','restaurant_id'=>'1'], //Greek
        //     [
        //         'restaurant_id' =>  1,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review4 = Review::firstOrCreate(
        //     ['id'=>'4','restaurant_id'=>'3'], //Greek
        //     [
        //         'restaurant_id' =>  3,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review5 = Review::firstOrCreate(
        //     ['id'=>'5','restaurant_id'=>'3'], //Greek
        //     [
        //         'restaurant_id' =>  3,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review6 = Review::firstOrCreate(
        //     ['id'=>'6','restaurant_id'=>'4'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review7 = Review::firstOrCreate(
        //     ['id'=>'7','restaurant_id'=>'4'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review8 = Review::firstOrCreate(
        //     ['id'=>'8','restaurant_id'=>'4'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review9 = Review::firstOrCreate(
        //     ['id'=>'9','restaurant_id'=>'4'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review10 = Review::firstOrCreate(
        //     ['id'=>'10','restaurant_id'=>'4'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review11 = Review::firstOrCreate(
        //     ['id'=>'11','restaurant_id'=>'5'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        // $review12 = Review::firstOrCreate(
        //     ['id'=>'12','restaurant_id'=>'6'], //Greek
        //     [
        //         'restaurant_id' =>  4,
        //         'comment'       =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'rating'        =>  $faker->numberBetween($min=0, $max=5),
        //         'updated_at'    =>  Carbon::now()->subMinute($faker->numberBetween($min=0, $max=200))
        //     ]
        // );
        
    }
}
