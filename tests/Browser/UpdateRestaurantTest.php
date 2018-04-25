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
            $restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $name = '';
            $desc = 'a';
            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->click('button[type="submit"]')
                    ->assertSee('The name field is required.')
                    ->assertSee('The description must be at least 3 characters.');
        });
    }

    public function test_user_can_update_restaurant_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $name = 'bebo';
            $desc = 'some random text';
            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $name)
                    ->type('description',$desc)
                    ->click('button[type="submit"]')
                    ->assertDontSee('The name field is required.')
                    ->assertDontSee('The description must be at least 3 characters.')
                    ->assertSee($name ." restaurant updated");
        });
    }
    public function test_user_cannot_update_restaurant_with_non_unquie_name()
    {
        $this->browse(function (Browser $browser) {
            //Create Restaurant
            $restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $restaurant2 = Restaurant::create(['name' => 'Jimmy','description' => 'Jimmy Text']);
            //visit create page
            $browser->visit('/restaurants/'.$restaurant1->id.'/edit')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant1->description)
                    ->click('button[type="submit"]')
                    ->assertSee('The name has already been taken.');
        });
    }
}
