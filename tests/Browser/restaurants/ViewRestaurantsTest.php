<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewRestaurantsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    use DatabaseMigrations;


    public function test_guest_can_view_no_restaurants()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPathIs('/restaurants')
                    ->assertSeeIn('h1', 'Restaurants')
                    ->assertSee('No restaurants avaliable.');
        });
    }

    public function test_guest_can_view_restaurants()
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

            //dd($restaurant2->full_address());
            //$full_address = $restaurant2->full_address();
            $browser->visit('/')
                    ->assertPathIs('/restaurants')
                    ->assertSeeIn('h1', 'Restaurants')
                    ->assertDontSee('No restaurants avaliable.')
                    ->assertSeeIn('#restaurant'.$restaurant1->id,e($restaurant1->name))
                    ->assertSeeIn('#restaurant'.$restaurant1->id,e($restaurant1->full_address()))
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->name))
                    ->assertSeeIn('#restaurant'.$restaurant2->id,e($restaurant2->full_address()));
 
        });
    }
}
