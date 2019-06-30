<?php
declare(strict_types=1);

namespace Tests\Browser\Reviews;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\Review as Review;
use App\Models\User;


use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Throwable;
use \Faker\Factory;


/**
 * Class CreateRestaurantReviewTest
 * @package Tests\Browser\Reviews;
 */
class CreateRestaurantReviewTest extends DuskTestCase
{

    use DatabaseMigrations;

	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function user_cannot_create_restaurant_review_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = Factory::create();

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

            $review1 = new Review(
                [
                    'comment'   => 'a'
                ]
            );

            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create')
                    ->type('comment',$review1->comment)
                    ->click('.add-review')
                    ->assertSee('The comment must be at least 3 characters.');
                    //->assertSee('The rating field is required');
            $browser->visit('restaurants/'.$restaurant1->id)
                    ->assertMissing('#review1') 
                    ->assertSee('No reviews available for this restaurant');
        });
    }


	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function user_can_create_restaurant_review_with_valid_details() :void
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurants
            $faker = Factory::create();

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

            $review1 = new Review(
                [
                    'comment'   => 'My text',
                    'rating'    => '3'
                ]
            );


            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create')
                    ->type('comment',$review1->comment)
                    ->type('rating', $review1->rating)
                    ->click('.add-review')
//                    ->assertPresent('#review1')
//	            ->assertPresent('#review2')
                    ->assertSeeIn('.no-of-reviews','1') 
                    ->assertSeeIn('#review1',$review1->comment)
                    ->assertSeeIn('#review1',floor(floatval($review1->rating)))
                    ->assertSeeIn('#review1',3);
//                    ->assertDontSee('No reviews available for this restaurant');
            $browser->assertDontSee('No reviews available for this restaurant');
        });
    }
}
