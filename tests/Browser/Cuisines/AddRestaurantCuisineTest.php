<?php
declare(strict_types=1);

namespace Tests\Browser\Cuisines;

//Models
use App\Models\Restaurant as Restaurant;
use App\Models\Cuisine as Cuisine;
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;
use Tests\Browser\MyHelper\DuskFormHelper;


/**
 * Class AddRestaurantCuisineTest
 * @package Tests\Browser\cuisine
 */
class AddRestaurantCuisineTest extends DuskTestCase
{

    use DatabaseMigrations;
	use DuskFormHelper;


    /**
     * Setup Cuisine
     *
     * @return void
     */
    public function SetUpCuisines() :void
    {
        //Create Cuisines
        Cuisine::create(['name'=>'French']);
        Cuisine::create(['name'=>'British']);
        Cuisine::create(['name'=>'Japanese']);
    }


	/**
	 * @throws Throwable
	 * @return void
	 */
	public function test_user_can_create_restaurant_with_a_cuisine_type() :void
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->SetUpCuisines();
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

	        //Users
	        $user1 = factory(User::class)->create();

            // Restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->make();

            $browser->loginAs($user1)
                    ->visit('/restaurants/create');
	        $this->submitForm($browser,[
		        ['field_name' =>'name',                 'field_value'=>$restaurant2->name,          'field_type'=>'text'],
		        ['field_name' =>'description',          'field_value'=>$restaurant2->description,   'field_type'=>'text'],
		        ['field_name' =>'address1',             'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
		        ['field_name' =>'address2',             'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
		        ['field_name' =>'city',                 'field_value'=>$restaurant2->city,          'field_type'=>'text'],
		        ['field_name' =>'county',               'field_value'=>$restaurant2->county,        'field_type'=>'text'],
		        ['field_name' =>'postcode',             'field_value'=>$restaurant2->postcode,      'field_type'=>'text'],
		        ['field_name' =>$cuisine1->name,        'field_value'=>null,                        'field_type'=>'checkbox']
	        ]);
	        //show
            $browser->assertSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // index
                    ->assertSeeIn('#restaurant'.$restaurant1->id.' .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ->logout()
                    ;
        });
    }

	/**
	 * @throws Throwable
	 * @return void
	 */
	public function test_user_can_create_restaurant_with_multiple_cuisine_type() :void
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->SetUpCuisines();
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

            //Users
	        $user1 = factory(User::class)->create();

            // Restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->make();

            $browser->loginAs($user1)
                    ->visit('/restaurants/create');
	        $this->submitForm($browser,[
		        ['field_name' =>'name',                 'field_value'=>$restaurant2->name,          'field_type'=>'text'],
		        ['field_name' =>'description',          'field_value'=>$restaurant2->description,   'field_type'=>'text'],
		        ['field_name' =>'address1',             'field_value'=>$restaurant2->address1,      'field_type'=>'text'],
		        ['field_name' =>'address2',             'field_value'=>$restaurant2->address2,      'field_type'=>'text'],
		        ['field_name' =>'city',                 'field_value'=>$restaurant2->city,          'field_type'=>'text'],
		        ['field_name' =>'county',               'field_value'=>$restaurant2->county,        'field_type'=>'text'],
		        ['field_name' =>'postcode',             'field_value'=>$restaurant2->postcode,      'field_type'=>'text'],
		        ['field_name' =>$cuisine1->name,        'field_value'=>null,                        'field_type'=>'checkbox'],
		        ['field_name' =>$cuisine2->name,        'field_value'=>null,                        'field_type'=>'checkbox']
	        ]);

            //Show
            $browser->assertSeeIn('.cuisine-value',$cuisine1->name)
		            ->assertSeeIn('.cuisine-value',$cuisine2->name)
		            ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
		            ->press('#view-restaurants')
		            // Index
		            ->assertSeeIn('#restaurant'.$restaurant1->id.' .cuisine-value','Not specified')
		            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
		            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
		            ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ->logout()
            ;
        });
    }
}
