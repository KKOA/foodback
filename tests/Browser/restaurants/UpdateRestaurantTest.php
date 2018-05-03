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

    public function test_user_cannot_update_restaurant_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {

            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'address2'      =>  '',
                    'city'          =>  'Shrewsbury',
                    'county'        =>  '',
                    'postcode'      =>  'SY1 1RD'
                ]
            );
            //$restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $name='';
            $desc='a';
            $address1='';
            $city='au';
            $postcode='sn5 5ef fe6';
            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
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

    public function test_user_can_update_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'address2'      =>  '',
                    'city'          =>  'Shrewsbury',
                    'county'        =>  '',
                    'postcode'      =>  'SY1 1RD'
                ]
            );
            //$restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $name = 'bebo';
            $desc = 'some random text';
            $address1='28 Church Road';
            $city='Hove';
            $county='East Sussex';
            $postcode='BN3 2FN';
            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->type('address1',$address1)
                    ->type('city',$city)
                    ->type('county',$county)
                    ->type('postcode',$postcode)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The address1 field is required.')
                    ->assertDontSee('The potcode must be at least 3 characters.')
                    ->assertSee($name ." restaurant updated");
        });
    }
    public function test_user_cannot_update_restaurant_with_non_unquie_name()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurant
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'address2'      =>  '',
                    'city'          =>  'Shrewsbury',
                    'county'        =>  '',
                    'postcode'      =>  'SY1 1RD'
                ]
            );
            $restaurant2 = Restaurant::create(
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
            //$restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            //$restaurant2 = Restaurant::create(['name' => 'Jimmy','description' => 'Jimmy Text']);
            
            $name = $restaurant1->name;
            $desc = 'some random text';
            $address1='28 Church Road';
            $address2='Rackton';
            $city='Hove';
            $postcode='BN3 2FN';

            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
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
