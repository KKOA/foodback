<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewRestaurantsTest extends DuskTestCase
{
    
    use DatabaseMigrations;

    /**
     * Test the guest can see the appropriate  message when no restaurants exist
     *
     * @return void
     */
    public function test_guest_can_see_no_avaliable_restaurants()
    {
        $this->browse(function (Browser $browser) {
            $restaurant1 = new Restaurant(
                [
                    'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );
            $browser->visit('/restaurants')
                    ->assertPathIs('/restaurants')
                    ->assertSee('No restaurants avaliable.')
                    ->assertMissing('#restaurant1') 
                    ->assertDontSee($restaurant1->name)
                    ->assertDontSee($restaurant1->full_address())
                    ->assertDontSee($restaurant1->description);
        });
    }


    /**
     * Test the guest can see the appropriate message when restaurants exist
     *
     * @return void
     */
    public function test_guest_can_see_avaliable_restaurants()
    {
        $this->browse(function (Browser $browser) {
            
            //Create Restaurants
            $restaurant1 = Restaurant::create(
                [
                    'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );
            $restaurant2 = Restaurant::create(
                [
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
                    ->assertSeeIn('#restaurant'.$restaurant1->id,e($restaurant1->full_address()))
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->name))
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->full_address()))
                    ->assertSeeIn('#restaurant2 .cuisine-value','Not specified')
                    ->assertSeeIn('.total-restaurants',2)
                    ->assertDontSee('No restaurants avaliable.')
                    ;
 
        });
    }
}
