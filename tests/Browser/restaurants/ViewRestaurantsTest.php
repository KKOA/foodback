<?php

namespace Tests\Browser\Restaurants;

// Models
use App\Models\Restaurant as Restaurant;
use App\Models\User as User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use \Throwable;

/**
 * Class ViewRestaurantsTest
 * @package Tests\Browser\Restaurants
 */
class ViewRestaurantsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test the guest can see the appropriate  message when no restaurants exist
     * @throws Throwable
     * @return void
     */
    public function test_guest_can_see_no_available_restaurants() :void
    {
        $this->browse(function (Browser $browser) {

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->make(['user_id'=>$user1->id]);

            $browser->visit('/restaurants')
                    ->assertPathIs('/restaurants')
                    ->assertSee('No restaurants available.')
                    ->assertMissing('#restaurant1') 
                    ->assertDontSee($restaurant1->name)
                    ->assertDontSee($restaurant1->fullAddress())
                    ->assertDontSee($restaurant1->description);
        });
    }


    /**
     * Test the guest can see the appropriate message when restaurants exist
     * @throws Throwable
     * @return void
     */
    public function test_guest_can_see_available_restaurants() :void
    {
        $this->browse(function (Browser $browser) {

			//users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create([
	        	'user_id'=>$user1->id,
		        'name'=>"Effertz, O&#039;Keefe And Heaney"
//		        'name'=>"Effertz, O'Keefe And Heaney"
	        ]);

            $browser->visit('/restaurants')
                    ->assertPathIs('/restaurants')
                    ->assertSeeIn('#restaurant'.$restaurant1->id,$restaurant1->name)
                    ->assertSeeIn('#restaurant'.$restaurant1->id,$restaurant1->fullAddress())
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant'.$restaurant2->id,$restaurant2->name)
                    ->assertSeeIn('#restaurant'.$restaurant2->id,$restaurant2->fullAddress())
                    ->assertSeeIn('#restaurant2 .cuisine-value','Not specified')
                    ->assertSeeIn('.total-restaurants',2)
                    ->assertDontSee('No restaurants available.')
            ;
        });
    }
}
