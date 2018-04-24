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

    
    public function test_guest_can_view_no_restaurants()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPathIs('/restaurants')
                    ->assertSeeIn('h1', 'Restaurants')
                    ->assertSee('No restaurants avaliable.');
        });
    }

    // public function test_guest_can_view_restaurants()
    // {
    //     $this->browse(function (Browser $browser) {
    //         //Create Restaurants
    //         $browser->visit('/')
    //                 ->assertPathIs('/restaurants')
    //                 //->assertURLIs('/restaurants')
    //                 ->assertSeeIn('h1', 'Restaurants')
    //                 ->assertDontSee('No restaurants avaliable.')
    //                 ->assertSeeIn('#restaurant'.$restaurant1->id,$restaurant1->name)
    //                 ->assertSeeIn('#restaurant'.$restaurant2->id,$restaurant2->name);
    //                 //Check database count 
    //     });
    // }
}
