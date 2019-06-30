<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Throwable;
use \Faker\Factory;
use Tests\Browser\MyHelper\DuskFormHelper;


/**
 * Class UpdateRestaurantTest
 * @package Tests\Browser\Restaurants
 */
class UpdateRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DuskFormHelper;

	/**
	 * @param Browser $browser
	 * @param array $fields
	 */
	public function submitForm(Browser $browser, array $fields)
	{
		$this->fillTextFields($browser, array_filter($fields,[$this, "isTextField"]));
		$browser->click('button[type="submit"]');
	}

	/**
	 * Test owner cannot update their own restaurant with invalid details.
	 *
	 * @throws Throwable
	 * @return void
	 */
    public function test_owner_cannot_update_their_own_restaurant_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {
            $faker = Factory::create();

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
                    'user_id'       =>  $user1->id,
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
	                ->visit('/restaurants/'.$restaurant1->id.'/edit');
            ;

            $this->submitForm($browser,[
//	                	['field_name' =>'','field_value'=>'', 'field_type'=>'']
                ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
                ['field_name' =>'description',  'field_value'=>$restaurant2->description,   'field_type'=>'text'],
                ['field_name' =>'address1',     'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
                ['field_name' =>'address2',     'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
                ['field_name' =>'city',         'field_value'=>$restaurant2->city,          'field_type'=>'text'],
                ['field_name' =>'county',       'field_value'=>$restaurant2->county,        'field_type'=>'text'],
                ['field_name' =>'postcode',     'field_value'=>$restaurant2->postcode,      'field_type'=>'text']
            ]);
            $browser->assertSee('The name field is required.')
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
     * @throws Throwable
     * @return void
     */ 
    public function test_guest_cannot_update_a_restaurant() :void
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();

	        $user1 = User::firstOrCreate(
		        ['name'          =>  'Keith'],
		        [
			        'name'          =>  'Keith',
			        'email'         => 'keith@test.com',
			        'password'  =>  bcrypt('nisbets')
		        ]
	        );



            $restaurant1 = Restaurant::create(
                [
	                'user_id'       =>  $user1->id,
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
     * @throws Throwable
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
	                'user_id'       =>  $user1->id,
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
                    ->visit('/restaurants/'.$restaurant1->id.'/edit');
            $this->submitForm($browser,[
//	                	['field_name' =>'','field_value'=>'', 'field_type'=>'']
	            ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
	            ['field_name' =>'description',  'field_value'=>$restaurant2->description,   'field_type'=>'text'],
	            ['field_name' =>'address1',     'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
	            ['field_name' =>'address2',     'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
	            ['field_name' =>'city',         'field_value'=>$restaurant2->city,          'field_type'=>'text'],
	            ['field_name' =>'county',       'field_value'=>$restaurant2->county,        'field_type'=>'text'],
	            ['field_name' =>'postcode',     'field_value'=>$restaurant2->postcode,      'field_type'=>'text']
            ]);
            $browser->assertDontSee('The address1 field is required.')
                    ->assertDontSee('The potcode must be at least 3 characters.')
                    ->assertSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }

    /**
     * Test owner cannot update their own restaurant with a name that has already been taken.
     * @throws Throwable
     * @return void
     */
    public function test_owner_cannot_update_their_own_restaurant_with_non_unique_name()
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
	                'user_id'       =>  $user1->id,
                	'name'          =>  'Bistro Jacques',
                    'description'   =>  'Bistro Jacques text',
                    'address1'      =>  '29 Claremount Street',
                    'city'          =>  'Shrewsbury',
                    'postcode'      =>  'SY1 1RD'
                ]
            );
            $restaurant2 = Restaurant::create(
                [
	                'user_id'       =>  $user1->id,
                	'name'          =>  'Bear & Billet',
                    'description'   =>  'some description',
                    'address1'      =>  '94 Lower Bridge Street',
                    'city'          =>  'Chester',
                    'postcode'      =>  'CH1 1RU'
                ]
            );

            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit');
//                  ->type('name', $restaurant2->name)
//	                ->click('button[type="submit"]')

            $this   ->submitForm($browser,[
//	                	['field_name' =>'','field_value'=>'', 'field_type'=>'']
                ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
            ]);

            $browser->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }
}
