<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
     * @throws Throwable;
     * @return void
     */
    public function test_guest_can_see_no_available_restaurants()
    {
        $this->browse(function (Browser $browser) {

	        $user1 = User::firstOrCreate(
		        ['name'          =>  'Keith'],
		        [
			        'name'          =>  'Keith',
			        'email'         => 'keith@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );

            $restaurant1 = new Restaurant(
                [
                    'user_id'       => $user1->id,
                	'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );
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
     * @throws Throwable;
     * @return void
     */
    public function test_guest_can_see_available_restaurants()
    {
        $this->browse(function (Browser $browser) {

	        $user1 = User::firstOrCreate(
		        ['name'          =>  'Keith'],
		        [
			        'name'          =>  'Keith',
			        'email'         => 'keith@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );

            //Create Restaurants
            $restaurant1 = Restaurant::create(
                [
	                'user_id'       => $user1->id,
                	'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );
            $restaurant2 = Restaurant::create(
                [
	                'user_id'       => $user1->id,
                	'name'          => 'Jimmy',
                    'description'   => 'Jimmy Text',
                    'address1'      =>  '28 Church Road',
                    'address2'      =>  'Chalkton',
                    'city'          =>  'Hove',
                    'postcode'      =>  'BN3 2FN'
                ]
            );

            $browser->visit('/restaurants')
                    ->assertPathIs('/restaurants')
                    ->assertSeeIn('#restaurant'.$restaurant1->id,e($restaurant1->name))
                    ->assertSeeIn('#restaurant'.$restaurant1->id,e($restaurant1->fullAddress()))
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->name))
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->fullAddress()))
                    ->assertSeeIn('#restaurant2 .cuisine-value','Not specified')
                    ->assertSeeIn('.total-restaurants',2)
                    ->assertDontSee('No restaurants available.')
                    ;
 
        });
    }
}
