<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\Review as Review;

//Datetime manipulation
Use Carbon\Carbon as Carbon;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewRestaurantReviewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_guest_cannot_see_restaurant_reviews()
    {
        $this->browse(function (Browser $browser) {    
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

            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Thai Garden',
                    'description'   =>  'Thai Garden text',
                    'address1'      =>  '100 West Street',
                    'address2'      =>  '',
                    'city'          =>  'Bristol',
                    'county'        =>  '',
                    'postcode'      =>  'BS3 3LR'
                ]
            );

            $review1 = Review::create(
                [
                    'restaurant_id' => $restaurant2->id,
                    'comment'       =>  $faker->paragraph,
                    'rating'        =>  3
                ]
            );
            $browser->visit('/restaurants/'.$restaurant1->id)
                ->assertSee('No reviews avaliable for this restaurant')
                ->assertDontSee($review1->rating)
                ->assertDontSee($review1->comment)
                ->assertDontSee($review1->updated_at)
                //->assertSeeIn('.no-of-reviews','0')
                ;
        });
    }

    public function test_guest_can_see_restaurant_reviews()
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

            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Thai Garden',
                    'description'   =>  'Thai Garden text',
                    'address1'      =>  '100 West Street',
                    'address2'      =>  '',
                    'city'          =>  'Bristol',
                    'county'        =>  '',
                    'postcode'      =>  'BS3 3LR'
                ]
            );
            //Create Reviews
            $review1 = Review::create(
                [
                    'restaurant_id' => $restaurant1->id,
                    'comment'       =>  $faker->paragraph,
                    'rating'        =>  3
                ]
            );
            $review2 = Review::create(
                [
                    'restaurant_id' => $restaurant2->id,
                    'comment'       =>  'Some more text',
                    'rating'        =>  4,
                    'updated_at'    =>  Carbon::now()->subMinute(90) //Set date to now - 90 minutes
                ]
            );
            // View page
            $browser->visit('/restaurants/'.$restaurant1->id)
            ->assertSee($review1->comment)
            ->assertSee($review1->rating)
            ->assertSee($review1->updated_at)
            ->assertSeeIn('.no-of-reviews','1')
            ->assertDontSee($review2->comment)
            ->assertDontSee($review2->updated_at)
            ->assertDontSee('No reviews avaliable for this restaurant')
            ;
            //->assertDontSee($review2->comment);
        });
    }

    public function test_new_restaurant_has_start_off_with_no_reviews_and_no_avg_rating()
    {
        $this->browse(function (Browser $browser) {
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
            $browser->visit('/restaurants')
                    ->assertSeeIn('#restaurant1','No reviews yet.');

        });
    }

    public function test_guest_can_view_each_restaurants_total_review_and_avg_rating()
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

            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Thai Garden',
                    'description'   =>  'Thai Garden text',
                    'address1'      =>  '100 West Street',
                    'address2'      =>  '',
                    'city'          =>  'Bristol',
                    'county'        =>  '',
                    'postcode'      =>  'BS3 3LR'
                ]
            );

            //Create Reviews
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
                    'rating'        =>  5,
                    'updated_at'    =>  Carbon::now()->subMinute(90) //Set date to now - 90 minutes
                ]
            );
            $review3 = Review::create(
                [
                    'restaurant_id' => $restaurant2->id,
                    'comment'       => $faker->paragraph,
                    'rating'        =>  2,
                    'updated_at'    =>  Carbon::now()->addMinute(30) //Set date to now + 30 minutes
                ]
            );

            // View page
            $browser->visit('/restaurants')
            ->assertSeeIn('#restaurant1 .avg-rating',$restaurant1->reviews->avg('rating'))
            ->assertSeeIn('#restaurant1 .no-of-reviews',$restaurant1->reviews->count())
            ->assertSeeIn('#restaurant2 .avg-rating',$restaurant2->reviews->avg('rating'))
            ->assertSeeIn('#restaurant2 .no-of-reviews',$restaurant2->reviews->count())
            
            ->assertDontSeeIn('#restaurant1 .no-of-reviews',$restaurant2->reviews->count())
            ->assertDontSeeIn('#restaurant1 .avg-rating',$restaurant2->reviews->avg('rating'))
            
            ->assertDontSeeIn('#restaurant2 .no-of-reviews',$restaurant1->reviews->count())
            ->assertDontSeeIn('#restaurant2 .avg-rating',$restaurant1->reviews->avg('rating'))
            ;
        });
    }



}