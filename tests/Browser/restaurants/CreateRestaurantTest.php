<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateRestaurantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    use DatabaseMigrations;

    public function test_user_cannot_create_restaurant_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {
            $name='';
            $desc='a';
            $address1='';
            $city='au';
            $postcode='sn5 5ef fe6';
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->type('address1',$address1)
                    ->type('city',$city)
                    ->type('postcode',$postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.')
                    ->assertSee('The address1 field is required.')
                    ->assertSee('The city must be at least 3 characters.')
                    ->assertSee('The postcode may not be greater than 10 characters.')
                    ;
        });
    }

    public function test_user_can_create_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $name = 'bebo';
            $desc = 'some random text';
            $address1='28 Church Road';
            $city='Hove';
            $county='East Sussex';
            $postcode='BN3 2FN';
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->type('address1',$address1)
                    ->type('city',$city)
                    ->type('county',$county)
                    ->type('postcode',$postcode)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The name field is required.')
                    ->assertDontSee('The description must be at least 3 characters.')
                    ->assertSee($name ." restaurant created");
        });
    }
    public function test_user_cannot_create_restaurant_with_non_unquie_name()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurant
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bear & Billet',
                    'description'   =>  'some description',
                    'address1'      =>  '94 Lower Bridge Street',
                    'address2'      =>  '',
                    'city'          =>  'Chester',
                    'county'        =>  '',
                    'postcode'      =>  'CH1 1RU'
                ]
            );

            $name = $restaurant1->name;
            $desc = 'some random text';
            $address1='28 Church Road';
            $address2='Rackton';
            $city='Hove';
            $postcode='BN3 2FN';
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->type('address1',$address1)
                    ->type('address2',$address2)
                    ->type('city',$city)
                    ->type('postcode',$postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.');
        });
    }
}
