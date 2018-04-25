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
            $name = '';
            $desc = 'a';
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.');
        });
    }

    public function test_user_can_create_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $name = 'bebo';
            $desc = 'some random text';
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $name)
                    ->type('description',$desc)
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
            $restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            //visit create page
            $browser->visit('/restaurants/create')
                    ->type('name', $restaurant1->name)
                    ->type('description',$restaurant1->description)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.');
        });
    }
}
