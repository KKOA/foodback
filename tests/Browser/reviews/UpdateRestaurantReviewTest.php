<?php

namespace Tests\Browser\Reviews;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\Review as Review;

use App\Models\User;
Use Carbon\Carbon as Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Throwable;

/**
 * Class EditRestaurantReviewTest
 * @package Tests\Browser\Reviews
 */
class UpdateRestaurantReviewTest extends DuskTestCase
{
    use DatabaseMigrations;

	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function review_owner_cannot_update_their_own_review_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = \Faker\Factory::create();

	        $user1 = User::firstOrCreate(
		        ['name'          =>  'Keith'],
		        [
			        'name'          =>  'Keith',
			        'email'         => 'keith@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );

            $restaurant1 = Restaurant::create(
                [
                    'user_id'       => $user1->id,
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
                    'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
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
                    ->assertSeeIn('.no-of-reviews','2')
                    ->assertDontSee('No reviews available for this restaurant')
                    ;
                    
        });
    }



	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function review_owner_can_update_their_own_review_with_valid_details() :void
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = \Faker\Factory::create();

	        $user1 = User::firstOrCreate(
		        ['name'          =>  'Keith'],
		        [
			        'name'          =>  'Keith',
			        'email'         => 'keith@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );

            $restaurant1 = Restaurant::create(
                [
                    'user_id'         =>  $user1->id,
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
                    'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
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
                    ->assertSeeIn('.no-of-reviews','2')
                    ->assertDontSee('No reviews available for this restaurant');
        });
    }
}
