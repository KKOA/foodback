<?php

namespace Tests\Browser\Reviews;

use App\Models\Restaurant as Restaurant;
use App\Models\Review as Review;
use App\Models\User;
Use Carbon\Carbon as Carbon;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;

/**
 * Class DeleteRestaurantReviewTest
 * @package Tests\Browser\Reviews
 */
class DeleteRestaurantReviewTest extends DuskTestCase
{

    use DatabaseMigrations;

	/**
	 * @test
	 * @throws Throwable;
	 * @return void
	 */
	public function review_owner_can_delete_their_own_review() :void
    {
        $this->browse(function (Browser $browser) {

	        //user
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

	        //review
	        $review1 = factory(Review::class)->create(['restaurant_id' => $restaurant1->id]);
	        $review2 = factory(Review::class)->create(
		        [
			        'restaurant_id' => $restaurant1->id,
			        'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
		        ]
	        );

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
