<?php

namespace Tests\Browser\cuisine;

use App\Restaurant as Restaurant;
use App\Cuisine as Cuisine;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;



class AddRestaurantCuisineTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function SetUpCusines()
    {
        //Create Cuisines
        Cuisine::create(['name'=>'French']);
        Cuisine::create(['name'=>'British']);
        Cuisine::create(['name'=>'Japanese']);
    }

    public function SetUpRestaurants()
    {
        //Create Cuisines
        Restaurant::create(
            [
                'name'          => 'Benny',
                'description'   => 'Benny Text',
                'address1'      =>  '47 North Baliey',
                'city'          =>  'Durham',
                'postcode'      =>  'DH1 3ET'
            ]
        );
    }
    
    public function test_user_can_see_restaurant_default_cuisine_type()
    {
        $this->browse(function (Browser $browser) {
            
            $this->SetUpRestaurants();
            $browser->visit('/')
            //Index
            ->assertSeeIn('#restaurant1 .cuisine-value','Not specified');
        });

        
    }

    public function test_user_can_create_restaurant_with_a_cuisine_type()
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->SetUpCusines();
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

            // Restaurants
            $this->SetUpRestaurants();

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

            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('#'.$cuisine1->name)
                    ->click('button[type="submit"]')
                    //show
                    ->assertSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // index
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ;
        });

        
    }

    public function test_user_can_create_restaurant_with_mutlipe_cuisine_type()
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->SetUpCusines();
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

            // Restaurants
            $this->SetUpRestaurants();
            
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

            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('#'.$cuisine1->name)
                    ->click('#'.$cuisine2->name)
                    ->click('button[type="submit"]')
            //Show
            ->assertSeeIn('.cuisine-value',$cuisine1->name)
            ->assertSeeIn('.cuisine-value',$cuisine2->name)
            ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
            ->press('#view-restaurants')
            // Index
            ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
            ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name);
        });
    }
}
