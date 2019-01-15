<?php

namespace Tests\Browser;

//Models
use App\Restaurant as Restaurant;
use App\User as user;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test owner can delete their own restaurant
     *
     * @return void
     */
    public function test_owner_can_delete_their_own_restaurant()
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
            
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id)
                    //->clickLink('Delete Restaurant')
                    ->press('Delete Restaurant')
                    ->press('#delete-btn')
                    ->assertSee("$name restaurant deleted")
                    ->assertSee($restaurant2->name)
                    ->assertDontSeeIn('.restaurants',$name)
                    ->logout();
        });
    }

    /**
     * test restaurant cannot be deleted by someone who is not owner of the restaurant
     *
     * @return void
     */
    public function test_non_owner_cannot_delete_anothers_restaurant()
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
            // Test guest
            $browser->visit('/restaurants/'.$restaurant1->id)
                    ->assertDontSeeIn('main','delete-restaurant')
            // Test User
                    ;
        });
    }
}
