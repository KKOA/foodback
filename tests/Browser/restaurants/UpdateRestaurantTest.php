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
	 * @return void
	 */
	public function submitForm(Browser $browser, array $fields) :void
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
	        $user1 = factory(User::class)->create();

            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

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
     * Test restaurant cannot be updated either by guest or user who is not the restaurant owner.
     * @throws Throwable
     * @return void
     */ 
    public function test_guest_cannot_update_a_restaurant() :void
    {
        $this->browse(function (Browser $browser) {

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

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
	        $user1 = factory(User::class)->create();

            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->make();


            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit');
            $this->submitForm($browser,[
	            ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
	            ['field_name' =>'description',  'field_value'=>$restaurant2->description,   'field_type'=>'text'],
	            ['field_name' =>'address1',     'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
	            ['field_name' =>'address2',     'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
	            ['field_name' =>'city',         'field_value'=>$restaurant2->city,          'field_type'=>'text'],
	            ['field_name' =>'county',       'field_value'=>$restaurant2->county,        'field_type'=>'text'],
	            ['field_name' =>'postcode',     'field_value'=>$restaurant2->postcode,      'field_type'=>'text']
            ]);
            $browser->assertDontSee('The address1 field is required.')
                    ->assertDontSee('The postcode must be at least 3 characters.')
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
	        $user1 = factory(User::class)->create();
	        $user2 = factory(User::class)->create();

            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user2->id]);

            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/'.$restaurant1->id.'/edit');

            $this   ->submitForm($browser,[
                ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
            ]);

            $browser->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant updated")
                    ->logout()
                    ;
        });
    }
}
