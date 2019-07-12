<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\User as user;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;

class DeleteRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test owner can delete their own restaurant
     * @throws Throwable
     * @return void
     */
    public function test_owner_can_delete_their_own_restaurant() :void
    {
        $this->browse(function (Browser $browser) {

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            $name = $restaurant1->name;
            
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id)
                    //->clickLink('Delete Restaurant')
                    ->press('Delete Restaurant')
                    ->press('#delete-btn')
                    ->assertSee("$name restaurant deleted")
                    ->assertSee($restaurant2->name)
                    ->assertDontSeeIn('.restaurants',$name)
                    ->logout();
        });
    }

    /**
     * test restaurant cannot be deleted by someone who is not owner of the restaurant
     * @throws Throwable
     * @return void
     */
    public function test_non_owner_cannot_delete_anothers_restaurant() :void
    {
        $this->browse(function (Browser $browser) {

            //users
	        $user1 = factory(User::class)->create();
	        $user2 = factory(User::class)->create();
            
            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            // Test guest
            $browser->visit('/restaurants/'.$restaurant1->id)
		        ->assertDontSeeIn('main','delete-restaurant');
            // Test user which does own a restaurant
	        $browser->loginAs($user2)
		            ->visit('/restaurants/'.$restaurant2->id)
		            ->assertDontSeeIn('main','delete-restaurant')
	                ->logout();

        });
    }
}
