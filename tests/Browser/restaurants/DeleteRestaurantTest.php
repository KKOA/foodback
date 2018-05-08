<?php

namespace Tests\Browser;

use App\Restaurant as Restaurant;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteRestaurantTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_owner_can_delete_their_own_restaurant()
    {
        $this->browse(function (Browser $browser) {
            //$restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            //$restaurant2 = Restaurant::create(['name' => 'Jimmy','description' => 'Jimmy Text']);

            $restaurant1 = Restaurant::create(
                [
                    'name'          =>  'Infamous Diner',
                    'description'   =>  'Infamous Diner text',
                    'address1'      =>  '3-5 Basil Chambers Nicholas Croft',
                    'address2'      =>  '',
                    'city'          =>  'Manchester',
                    'county'        =>  '',
                    'postcode'      =>  'M4 1EY'
                ]
            );
    
            $restaurant2 = Restaurant::create(
                [
                    'name'          =>  'Los Gatos',
                    'description'   =>  'Los Gatos text',
                    'address1'      =>  '1-3 Devizes Road',
                    'address2'      =>  'Old Town',
                    'city'          =>  'Swindon',
                    'county'        =>  '',
                    'postcode'      =>  'SN4 4BJ'
                ]
            );

            $name = $restaurant1->name;
            $browser->visit('/restaurants/'.$restaurant1->id)
                    //->clickLink('Delete Restaurant')
                    ->press('Delete Restaurant')
                    ->assertSee("$name restaurant Deleted")
                    ->assertSee($restaurant2->name)
                    ->assertDontSeeIn('.restaurants',$name);
        });
    }
}
