<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\Review as Review;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateRestaurantReviewTest extends DuskTestCase
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

            $comment = 'a';
            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create')
                    ->type('comment',$comment)
                    ->click('.add-review')
                    ->assertSee('The comment must be at least 3 characters.')
                    ->assertSee('The rating field is required');
            $browser->visit('restaurants/'.$restaurant1->id)
                    ->assertMissing('#review1') 
                    ->assertSeeIn('.no-of-reviews','0');     
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

            $comment = 'My text';
            $rating = 3;
            $browser->resize(1920, 1080);
            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create')
                    ->type('comment',$comment)
                    ->type('rating', $rating)
                    ->click('.add-review')
                    ->assertPresent('#review1')
                    ->assertSeeIn('.no-of-reviews','1') 
                    ->assertSeeIn('#review1',$comment)
                    ->assertSeeIn('#review1',$rating);
        });
    }
}
