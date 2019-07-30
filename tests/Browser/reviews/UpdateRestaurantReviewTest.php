<?php

namespace Tests\Browser\Reviews;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\Review as Review;
use App\Models\User;

Use Carbon\Carbon as Carbon;
use Tests\Browser\MyHelper\DuskFormHelper;
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
    use DuskFormHelper;

	/**
	 * @test
	 * @throws Throwable
	 * @return void
	 */
	public function review_owner_cannot_update_their_own_review_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {

	        //user
			$user1 = factory(User::class)->create();
			$user2 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

	        //review
	        $review1 = factory(Review::class)->create([
				'user_id'		=> $user2->id,
				'restaurant_id' => $restaurant1->id,
		        'rating'        =>  3
	        ]);
	        $review2 = factory(Review::class)->create([
				'user_id'		=> $user2->id,                
		        'restaurant_id' => $restaurant1->id,
		        'rating'        =>  4,
		        'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
	        ]);

			$comment = 'a';
			
			$browser->loginAs($user2);
			// $browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit');
			$browser->visit('restaurants/'.$restaurant1->id)
			->click('#edit-restaurant-review'.$review1->id);

	        $this->submitForm($browser,[
		        ['field_name' =>'comment',  'field_value'=>'a',   'field_type'=>'text'],
	        ]);

            $browser->assertSee('The comment must be at least 3 characters.');
                    // Vist restaurant show
                    $browser->visit('restaurants/'.$restaurant1->id)
                    ->assertSeeIn('#review'.$review1->id,$review1->comment)
                    ->assertSeeIn('#review'.$review1->id,$review1->rating)
                    ->assertSeeIn('#review'.$review2->id,$review2->comment)
                    ->assertSeeIn('#review'.$review2->id,$review2->rating)
                    //Check number of reviews count for restaurant
                    ->assertSeeIn('.no-of-reviews','2')
                    ->assertDontSee('No reviews available for this restaurant')
					->logout()
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

	        //user
			$user1 = factory(User::class)->create();
			$user2 = factory(User::class)->create();
			$user3 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

	        //review
	        $review1 = factory(Review::class)->create([
				'user_id'		=> $user2->id, 
				'restaurant_id' => $restaurant1->id,
		        'rating'        =>  3
	        ]);
	        $review2 = factory(Review::class)->create([
				'user_id'		=> $user3->id, 
				'restaurant_id' => $restaurant1->id,
		        'rating'        =>  4,
		        'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
	        ]);
	        $review3 = factory(Review::class)->make([
	        	'rating'        =>  3,
		        'updated_at'    =>  Carbon::now()->subMinutes(90) //Set date to now - 90 minutes
	        ]);

			$browser->loginAs($user2);
			// $browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit');
			$browser->visit('restaurants/'.$restaurant1->id)
					->click('#edit-restaurant-review'.$review1->id);
            $this->submitForm($browser,[
                ['field_name' =>'comment',  'field_value'=>$review3->comment,   'field_type'=>'text'],
                ['field_name' =>'rating',  'field_value'=>$review3->rating,   'field_type'=>'text']
            ]);
            $browser->assertSeeIn('#review'.$review1->id,$review3->comment)
                    ->assertSeeIn('#review'.$review1->id,$review3->rating)
                    ->assertSeeIn('#review'.$review2->id,$review2->comment)
                    ->assertSeeIn('#review'.$review2->id,$review2->rating)
                    //Check number of reviews count for restaurant
                    ->assertSeeIn('.no-of-reviews','2')
					->assertDontSee('No reviews available for this restaurant')
					->logout()
					;
        });
    }

    /**
     * @test
	 * @throws Throwable
	 * @return void
     *
     */
	public function user_cannot_update_another_users_review()
	{
		$this->browse(function (Browser $browser) {
			//user
			$user1 = factory(User::class)->create();
			$user2 = factory(User::class)->create();
			$user3 = factory(User::class)->create();

			//restaurants
			$restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

			//review
			$review1 = factory(Review::class)->create([
			   'user_id'       => $user2->id,
			   'restaurant_id' => $restaurant1->id,
				
			]);

			$browser	->visit('/restaurants/'.$restaurant1->id)
			

			//Test guest
						->assertMissing('#edit-restaurant-review'.$review1->id)
			//edit page
		    			->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
						->assertPathIs('/login')

			//Test User3
						->visit('/restaurants/'.$restaurant1->id)
						->loginAs($user3)
						->assertMissing('#edit-restaurant-review'.$review1->id)
			//edit page
		    			->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
						->assertPathIs('/restaurants/'.$restaurant1->id)

			//Test Restaurant Owner ($user1)
						->visit('/restaurants/'.$restaurant1->id)
						->loginAs($user1)
						->assertMissing('#edit-restaurant-review'.$review1->id)
			//edit page
		     			->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
			 			->assertPathIs('/restaurants/'.$restaurant1->id)
						->logout()														
			;
		});
	}

    /*public function guest_cannot_update_a_user_review(){
	     $this->browse(function (Browser $browser) {
		     //user
			 $user1 = factory(User::class)->create();
			 $user2 = factory(User::class)->create();

		     //restaurants
		     $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

		     //review
		     $review1 = factory(Review::class)->create([
				'user_id'       => $user2->id,
			    'restaurant_id' => $restaurant1->id,
			     
		     ]);

		     $browser   ->visit('/restaurants/'.$restaurant1->id);
		     //show page
		     $browser   ->assertMissing('edit-review'.$review1->id);
		     //edit page
		    //  $browser   ->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
			            // ->assertUrlIs('/login');
	     });
	}*/


    /**
     * @test
     * @throws Throwable;
     * @return void
     *//*
	public function restaurant_owner_cannot_edit_a_users_review_on_their_restaurant() :void
	{
		$this->browse(function (Browser $browser) {

			//user
			$user1 = factory(User::class)->create();
			$user2 = factory(User::class)->create();

			//restaurants
			$restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

			//review
			$review1 = factory(Review::class)->create([

				'user_id'       => $user2->id,
				'restaurant_id' => $restaurant1->id,
			]);


			$browser->loginAs($user1)
					->visit('/restaurants/'.$restaurant1->id);
			//show page
			$browser->assertMissing('edit-review'.$review1->id);
			//edit page
			//$browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review1->id.'/edit')
			//	->assertUrlIs('/restaurants/'.$restaurant1->id)
			//	->assertSee("Restaurant owner cannot edit a user's review on their restaurant.");
			//;


		});

	}*/

	/*
 * @test
 * @throws Throwable;
 * @return void
 *//*
	public function user_cannot_edit_another_persons_review() :void
	{
		$this->browse(function (Browser $browser) {

			//user
			$user1 = factory(User::class)->create();
			$user2 = factory(User::class)->create();
			$user3 = factory(User::class)->create();

			//restaurants
			$restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user3->id]);

			//review
			$review1 = factory(Review::class)->create([

				'restaurant_id' => $restaurant1->id,
				'user_id'       => $user1->id,
			]);
			$review2 = factory(Review::class)->create([

				'restaurant_id' => $restaurant1->id,
				'user_id'       => $user2->id,
			]);


			$browser->loginAs($user1)
					->visit('/restaurants/'.$restaurant1->id);
			//show page
			$browser->assertPresent('edit-review'.$review1->id);
			$browser->assertMissing('edit-review'.$review2->id);
			//edit page
			$browser->visit('restaurants/'.$restaurant1->id.'/reviews/'.$review2->id.'/edit')
				->assertUrlIs('/restaurants/'.$restaurant1->id)
				->assertSee("Cannot edit another persons review");
			;
		});

	}
	*/
}
