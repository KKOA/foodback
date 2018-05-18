<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateRestaurantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_owner_cannot_update_their_own_restaurant_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {

            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'city'          =>  'Shrewsbury',
                    'postcode'      =>  'SY1 1RD'
                ]
            );

            $restaurant2 = new Restaurant([
                'name'          =>  '',
                'description'   =>  'a',
                'address1'      =>  '',
                'city'          =>  'au',
                'postcode'      =>  'sn5 5ef fe6'
            ]);

            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.')
                    ->assertSee('The address1 field is required.')
                    ->assertSee('The city must be at least 3 characters.')
                    ->assertSee('The postcode may not be greater than 10 characters.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ;
        });
    }

    public function test_owner_can_update_their_own_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'city'          =>  'Shrewsbury',
                    'postcode'      =>  'SY1 1RD'
                ]
            );

            $restaurant2 = new Restaurant([
                'name'          =>  'bebo',
                'description'   =>  'some random text',
                'address1'      =>  '28 Church Road',
                'city'          =>  'Hove',
                'county'        =>  'East Sussex',
                'postcode'      =>  'BN3 2FN'
            ]);

            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The address1 field is required.')
                    ->assertDontSee('The potcode must be at least 3 characters.')
                    ->assertSee($restaurant2->name ." restaurant updated");
        });
    }
    public function test_owner_cannot_update_their_own_restaurant_with_non_unquie_name()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurant
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'city'          =>  'Shrewsbury',
                    'postcode'      =>  'SY1 1RD'
                ]
            );
            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Bear & Billet',
                    'description'   =>  'some description',
                    'address1'      =>  '94 Lower Bridge Street',
                    'city'          =>  'Chester',
                    'postcode'      =>  'CH1 1RU'
                ]
            );

            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ;
        });
    }
}
