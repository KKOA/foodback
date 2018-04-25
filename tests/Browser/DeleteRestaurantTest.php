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

    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $restaurant1 = Restaurant::create(['name' => 'Benny','description' => 'Benny Text']);
            $restaurant2 = Restaurant::create(['name' => 'Jimmy','description' => 'Jimmy Text']);
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
