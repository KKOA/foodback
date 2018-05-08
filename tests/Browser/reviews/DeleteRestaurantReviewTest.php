<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use App\Review as Review;
Use Carbon\Carbon as Carbon;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteRestaurantReviewTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_review_owner_can_delete_their_own_review()
    {
        $this->browse(function (Browser $browser) {

            $faker = \Faker\Factory::create();
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Infamous Diner',
                    'description'   =>  'Infamous Diner text',
                    'address1'      =>  '3-5 Basil Chambers Nicholas Croft',
                    'address2'      =>  '',
                    'city'          =>  'Manchester',
                    'county'        =>  '',
                    'postcode'      =>  'M4 1EY'
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

            //$name = $restaurant1->name;
            $browser->visit('/restaurants/'.$restaurant1->id)
                    ->click('#delete-review'.$review1->id)
                    ->assertSee("Review deleted")
                    ->assertPresent('#review2')
                    ->assertSeeIn('#review2',$review2->comment)
                    ->assertSeeIn('#review2',$review2->rating)
                    ->assertMissing('#review1')
                    ->assertSeeIn('.no-of-reviews','1')
                    ;
            $browser->visit('/restaurants/')
                ->assertSeeIn('#restaurant1 .no-of-reviews',$restaurant1->reviews->count())
                ->assertSeeIn('#restaurant1 .avg-rating',$restaurant1->reviews->avg('rating'))
            ;
        });
    }
}
