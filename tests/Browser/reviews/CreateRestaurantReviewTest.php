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
use Tests\Browser\MyHelper\DuskFormHelper;

/**
 * Class CreateRestaurantReviewTest
 * @package Tests\Browser\Reviews;
 */
class CreateRestaurantReviewTest extends DuskTestCase
{

    use DatabaseMigrations;
    use DuskFormHelper;

	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function user_cannot_create_restaurant_review_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {

			//user
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

	        //Review
	        $review1 = factory(Review::class)->make(['comment' => 'a']);

            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create');
	        $this->submitForm($browser,[
		        ['field_name' =>'comment',  'field_value'=>$review1->comment,   'field_type'=>'text'],
	        ]);

            $browser->assertSee('The comment must be at least 3 characters.')
                    ->visit('restaurants/'.$restaurant1->id)
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

	        //user
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

	        //Review
	        $review1 = factory(Review::class)->make(['comment'   => 'My text', 'rating'    => '3']);

            $browser->visit('restaurants/'.$restaurant1->id.'/reviews/create');
            $this->submitForm($browser,[
                ['field_name' =>'comment',  'field_value'=>$review1->comment,   'field_type'=>'text'],
	            ['field_name' =>'rating',  'field_value'=>$review1->rating,   'field_type'=>'text']
            ]);

            $browser->assertSeeIn('.no-of-reviews','1')
                    ->assertSeeIn('#review1',$review1->comment)
                    ->assertSeeIn('#review1',floor(floatval($review1->rating)))
                    ->assertSeeIn('#review1',3);
//                    ->assertDontSee('No reviews available for this restaurant');
            $browser->assertDontSee('No reviews available for this restaurant');
        });
    }
}
