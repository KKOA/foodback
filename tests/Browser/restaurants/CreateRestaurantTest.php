<?php

namespace Tests\Browser;

// use Faker\Generator as Faker;

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
            $faker = \Faker\Factory::create();
            
            $restaurant1 = Restaurant::create(
                [
                    'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );

            $restaurant2 = new Restaurant(
                [
                    'name'          => '',
                    'description'   => 'a',
                    'address1'      =>  '',
                    'address2'      => 'sa',
                    'city'          =>  'au',
                    'county'      => $faker->paragraph(30,false),
                    'postcode'      =>  'sn5 5ef fe6'
                ]
            );

            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address2',$restaurant2->address2)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.')
                    ->assertSee('The address1 field is required.')
                    ->assertSee('The address2 must be empty or atleast 3 characters long.')
                    ->assertSee('The city must be at least 3 characters.')
                    ->assertSee('The county may not be greater than 255 characters.')
                    ->assertSee('The postcode may not be greater than 10 characters.')
                    ->assertDontSee($restaurant2->name ." restaurant created");
            //Visit homepage
            $browser->visit('/restaurants')
                    ->assertSeeIn('.total-restaurants',1)
                    ->assertPresent('#restaurant1')
                    ->assertSeeIn('#restaurant1',$restaurant1->name)
                    ->assertSeeIn('#restaurant1',$restaurant1->full_address())
                    ->assertMissing('#restaurant2')
                    ->assertDontSee($restaurant2->name)
                    ->assertDontSee($restaurant2->full_address())
            ;
        });
    }

    public function test_user_can_create_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {

            $restaurant1 = Restaurant::create(
                [
                    'name'          => 'Benny',
                    'description'   => 'Benny Text',
                    'address1'      =>  '47 North Baliey',
                    'city'          =>  'Durham',
                    'postcode'      =>  'DH1 3ET'
                ]
            );

            $restaurant2 = new Restaurant(
                [
                    'name'          =>  'bebo',
                    'description'   =>  'some random text',
                    'address1'      =>  '28 Church Road',
                    'city'          =>  'Hove',
                    'county'        =>  'East Sussex',
                    'postcode'      =>  'BN3 2FN'
                ]
            );

            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The name field is required.')
                    ->assertDontSee('The description must be at least 3 characters.')
                    ->assertSee($restaurant2->name ." restaurant created")
                    ->assertSee($restaurant2->description)
                    ->assertSee($restaurant2->full_address());
            //Visit homepage
            $browser->visit('/restaurants')
                    ->assertSeeIn('.total-restaurants',2)
                    ->assertPresent('#restaurant1')
                    ->assertSeeIn('#restaurant1',$restaurant1->name)
                    ->assertSeeIn('#restaurant1',$restaurant1->full_address())
                    ->assertPresent('#restaurant2')
                    ->assertSeeIn('#restaurant2',$restaurant2->name)
                    ->assertSeeIn('#restaurant2',$restaurant2->full_address())
                    ;
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
                    'city'          =>  'Chester',
                    'postcode'      =>  'CH1 1RU'
                ]
            );

            $restaurant2 = new Restaurant(
                [
                    'name'          =>  $restaurant1->name,
                    'description'   =>  'some random text',
                    'address1'      =>  '28 Church Road',
                    'address2'      =>  'Rackton',
                    'city'          =>  'Hove',
                    'postcode'      =>  'BN3 2FN'
                ]
            );

            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->desc)
                    ->type('address1',$restaurant2->address1)
                    ->type('address2',$restaurant2->address2)
                    ->type('city',$restaurant2->city)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant created")
                    ;
            //Visit homepage
            $browser->visit('/restaurants')
            ->assertPresent('#restaurant1')
            ->assertSeeIn('#restaurant1',$restaurant1->name)
            ->assertSeeIn('.total-restaurants',1)
            ->assertMissing('#restaurant2')
            ->assertDontSee($restaurant2->full_address())
            ;
        });
    }
}
