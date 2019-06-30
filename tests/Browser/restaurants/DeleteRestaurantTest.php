<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\User as user;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;

class DeleteRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test owner can delete their own restaurant
     * @throws Throwable
     * @return void
     */
    public function test_owner_can_delete_their_own_restaurant() :void
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
                    'user_id'       => $user1->id,
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
	                'user_id'       => $user1->id,
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
     * @throws Throwable
     * @return void
     */
    public function test_non_owner_cannot_delete_anothers_restaurant() :void
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

	        $user2 = User::firstOrCreate(
		        ['name'          =>  'Jon'],
		        [
			        'name'          =>  'Jon',
			        'email'         => 'jon@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );
            
            //restaurants
            $restaurant1 = Restaurant::create(
                [
                    'user_id'       =>  $user1->id,
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
	                'user_id'       =>  $user1->id,
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
