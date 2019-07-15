<?php
declare(strict_types=1);

namespace Tests\Browser\Restaurants;

// use Faker\Generator as Faker;

//Models
use App\Models\Restaurant;
use App\Models\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;
use Tests\Browser\MyHelper\DuskFormHelper;
use Faker\Factory as FakerFactory;


/**
 * Class CreateRestaurantTest
 * @package Tests\Browser\Restaurants
 */
class CreateRestaurantTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DuskFormHelper;

    /**
     * Test user cannot create a restaurant with invalid details 
     * @throws Throwable
     * @return void
     */
    public function test_user_cannot_create_restaurant_with_invalid_details() :void
    {
        
        $this->browse(function (Browser $browser) {
            $faker = FakerFactory::create();

	        //users
			$user1 = factory(User::class)->create();

	        //restaurants
			$restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

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
            $browser->loginAs($user1)
                    ->visit('/restaurants/create');
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
                    ->assertSeeIn('#restaurant1',$restaurant1->fullAddress())
                    ->assertMissing('#restaurant2')
                    ->assertDontSee($restaurant2->name)
                    ->assertDontSee($restaurant2->fullAddress())
                    ->logout();
        });
    }

    /**
     * Test guest cannot create a restaurant
     * @throws Throwable
     * @return void
     */
    public function test_guest_cannot_create_restaurant() :void
    {
        
        $this->browse(function (Browser $browser) {
            
            //visit create page
            $browser->visit('/restaurants/create')
                    ->assertSeeIn('#loginCard','Login with')
                    ->assertDontSeeIn('main','Create restaurant ');
        });
    }

    /**
     * Test user can create a restaurant with valid details.
     * @throws Throwable
     * @return void
     */
    public function test_user_can_create_restaurant_with_valid_details() :void
    {
        $this->browse(function (Browser $browser) {

            //users
	        $user1 = factory(User::class)->create();

            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->make();

            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/create');

            $this->submitForm($browser,[
                ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
                ['field_name' =>'description',  'field_value'=>$restaurant2->description,   'field_type'=>'text'],
                ['field_name' =>'address1',     'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
                ['field_name' =>'address2',     'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
                ['field_name' =>'city',         'field_value'=>$restaurant2->city,          'field_type'=>'text'],
                ['field_name' =>'county',       'field_value'=>$restaurant2->county,        'field_type'=>'text'],
                ['field_name' =>'postcode',     'field_value'=>$restaurant2->postcode,      'field_type'=>'text']
            ]);

            $browser->assertDontSee('The name field is required.')
                    ->assertDontSee('The description must be at least 3 characters.')
                    ->assertSee($restaurant2->name ." restaurant created")
                    ->assertSee($restaurant2->description)
                    ->assertSee($restaurant2->fullAddress());
            //Visit homepage
            $browser->visit('/restaurants')
                    ->assertSeeIn('.total-restaurants',2)
                    ->assertPresent('#restaurant1')
                    ->assertSeeIn('#restaurant1',$restaurant1->name)
                    ->assertSeeIn('#restaurant1',$restaurant1->fullAddress())
                    ->assertPresent('#restaurant2')
                    ->assertSeeIn('#restaurant2',$restaurant2->name)
                    ->assertSeeIn('#restaurant2',$restaurant2->fullAddress())
                    ->logout();
        });
    }

    /**
     * Test user cannot create a restaurant with a name that has already been taken.
     * @throws Throwable
     * @return void
     */
    public function test_user_cannot_create_restaurant_with_non_unique_name() :void
    {
        $this->browse(function (Browser $browser) {
            //users
	        $user1 = factory(User::class)->create();

            //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id' => $user1->id ]);
	        $restaurant2 = factory(Restaurant::class)->make(['name' =>  $restaurant1->name]);

            //visit create page
            $browser->loginAs($user1)
                    ->visit('/restaurants/create');
	        $this->submitForm($browser,[
		        ['field_name' =>'name',         'field_value'=>$restaurant2->name,          'field_type'=>'text'],
		        ['field_name' =>'description',  'field_value'=>$restaurant2->description,   'field_type'=>'text'],
		        ['field_name' =>'address1',     'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
		        ['field_name' =>'address2',     'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
		        ['field_name' =>'city',         'field_value'=>$restaurant2->city,          'field_type'=>'text'],
		        ['field_name' =>'county',       'field_value'=>$restaurant2->county,        'field_type'=>'text'],
		        ['field_name' =>'postcode',     'field_value'=>$restaurant2->postcode,      'field_type'=>'text']
	        ]);
            $browser->assertSee('The name has already been taken.')
                    ->assertDontSee($restaurant2->name ." restaurant created");
            //Visit homepage
            $browser->visit('/restaurants')
                    ->assertPresent('#restaurant1')
                    ->assertSeeIn('#restaurant1',$restaurant1->name)
                    ->assertSeeIn('.total-restaurants',1)
                    ->assertMissing('#restaurant2')
                    ->assertDontSee($restaurant2->fullAddress())
                    ->logout();
        });
    }
}
