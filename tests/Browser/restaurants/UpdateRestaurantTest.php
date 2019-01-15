<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test owner cannot update their own restaurant with invalid details.
     *
     * @return void
     */
    public function test_owner_cannot_update_their_own_restaurant_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();

            //users
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            //restaurants
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
                'name'          => '',
                'description'   => 'a',
                'address1'      =>  '',
                'address2'      => $faker->paragraph(30,false),
                'city'          =>  'au',
                'county'        => 'sa',
                'postcode'      =>  'sn5 5ef fe6'
            ]);

            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name',$restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('address2',$restaurant2->address2)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.')
                    ->assertSee('The address1 field is required.')
                    ->assertSee('The address2 may not be greater than 255 characters.')
                    ->assertSee('The city must be at least 3 characters.')
                    ->assertSee('The county must be empty or atleast 3 characters long.')
                    ->assertSee('The postcode may not be greater than 10 characters.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }

    /**
     * Test restaurant cannot be either by guest or user who is not the restaurant owner.
     *
     * @return void
     */ 
    public function test_guest_cannot_update_a_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'city'          =>  'Shrewsbury',
                    'postcode'      =>  'SY1 1RD'
                ]
            );

            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->assertSeeIn('#loginCard','Login with')
                    ->assertDontSeeIn('main','Edit restaurant')
                    ;
        });
    }

    /**
     * Test owner can update their own restaurant with valid details.
     *
     * @return void
     */ 
    public function test_owner_can_update_their_own_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {

            //users
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            //restaurants
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
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The address1 field is required.')
                    ->assertDontSee('The potcode must be at least 3 characters.')
                    ->assertSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }

    /**
     * Test owner cannot update their own restaurant with a name that has already been taken.
     *
     * @return void
     */
    public function test_owner_cannot_update_their_own_restaurant_with_non_unquie_name()
    {
        $this->browse(function (Browser $browser) {
            
            //users
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            //restaurants
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
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }
}
