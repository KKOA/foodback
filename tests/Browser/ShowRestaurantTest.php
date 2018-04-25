<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowRestaurantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    use DatabaseMigrations;
    
    public function test_guest_can_view_restaurant()
    {
        $this->browse(function (Browser $browser) {
            //$restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            //$restaurant2 = Restaurant::create(['name' => 'Jimmy','description' => 'Jimmy Text']);

            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Nur',
                    'description'   =>  'Nur text',
                    'address1'      =>  '22 Bridge Street',
                    'address2'      =>  '',
                    'city'          =>  'Glasgow',
                    'county'        =>  '',
                    'postcode'      =>  'G5 9HR'
                ]
            );
    
            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Thai Garden',
                    'description'   =>  'Thai Garden text',
                    'address1'      =>  '100 West Street',
                    'address2'      =>  '',
                    'city'          =>  'Bristol',
                    'county'        =>  '',
                    'postcode'      =>  'BS3 3LR'
                ]
            );


            $browser->visit('/restaurants/'.$restaurant1->id)
                    ->assertSee($restaurant1->name)
                    ->assertSee($restaurant1->description)
                    ->assertSee($restaurant1->full_address())
                    ->assertDontSee($restaurant2->name)
                    ->assertSeeLink('View Restaurant');
        });
    }
}
