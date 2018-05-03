<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\Review as Review;

Use Carbon\Carbon as Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditRestaurantReviewTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    
    public function test_user_cannot_create_restaurant_review_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = \Faker\Factory::create();
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Nur',
                    'description'   =>  'Nur text',
                    'address1'      =>  '22 Bridge Street',
                    'address2'      =>  '',
                    'city'          =>  'Glasgow',
                    'county'        =>  '',
                    'postcode'      =>  'G5 9HR'
                ]
            );

            $review1 = Review::create(
                [
                    'restaurant_id' => $restaurant1->id,
                    'comment'       =>  $faker->paragraph,
                    'rating'        =>  3
                ]
            );

            $review2 = Review::create(
                [
                    'restaurant_id' => $restaurant1->id,
                    'comment'       => $faker->paragraph,
                    'rating'        =>  4,
                    'updated_at'    =>  Carbon::now()->subMinute(90) //Set date to now - 90 minutes
                ]
            );

            $comment = 'a';
            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')

                    ->type('comment',$comment)
                    ->click('.edit-review')
                    ->assertSee('The comment must be at least 3 characters.');
                    // Vist restaurant show
                    $browser->visit('restaurants/'.$restaurant1->id)
                    ->assertSeeIn('#review'.$review1->id,$review1->comment)
                    ->assertSeeIn('#review'.$review1->id,$review1->rating)
                    ->assertSeeIn('#review'.$review2->id,$review2->comment)
                    ->assertSeeIn('#review'.$review2->id,$review2->rating)
                    //Check number of reviews count for restaurant
                    ->assertSeeIn('.no-of-reviews','2');
                    
        });
    }


    public function test_user_can_create_restaurant_review_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = \Faker\Factory::create();
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Nur',
                    'description'   =>  'Nur text',
                    'address1'      =>  '22 Bridge Street',
                    'address2'      =>  '',
                    'city'          =>  'Glasgow',
                    'county'        =>  '',
                    'postcode'      =>  'G5 9HR'
                ]
            );

            $review1 = Review::create(
                [
                    'restaurant_id' => $restaurant1->id,
                    'comment'       =>  $faker->paragraph,
                    'rating'        =>  3
                ]
            );

            $review2 = Review::create(
                [
                    'restaurant_id' => $restaurant1->id,
                    'comment'       => $faker->paragraph,
                    'rating'        =>  4,
                    'updated_at'    =>  Carbon::now()->subMinute(90) //Set date to now - 90 minutes
                ]
            );

            $comment = 'My text';
            $rating = 3;
            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
                    ->type('comment',$comment)
                    ->type('rating', $rating)
                    ->click('.edit-review')
                    ->assertSeeIn('#review'.$review1->id,$comment)
                    ->assertSeeIn('#review'.$review1->id,$rating)
                    ->assertSeeIn('#review'.$review2->id,$review2->comment)
                    ->assertSeeIn('#review'.$review2->id,$review2->rating)
                    //Check number of reviews count for restaurant
                    ->assertSeeIn('.no-of-reviews','2');
        });
    }
}
