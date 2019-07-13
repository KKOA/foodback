<?php
declare(strict_types=1);
namespace Tests\Browser\Cuisines;

//Models
use App\Models\Restaurant;
use App\Models\Cuisine;
use App\Models\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;
use Tests\Browser\MyHelper\DuskFormHelper;

/**
 * Class UpdateRestaurantCuisineTest
 * @package Tests\Browser\Cuisines
 */
class UpdateRestaurantCuisineTest extends DuskTestCase
{
    use DatabaseMigrations;
	use DuskFormHelper;

	/**
	 * @return void
	 */
	public function setUpCuisines() :void
    {
        //Create Cuisines
        Cuisine::create(['name'=>'French']);
        Cuisine::create(['name'=>'British']);
        Cuisine::create(['name'=>'Japanese']);
    }

	/**
	 * @param Browser $browser
	 * @param array $fields
	 */
	public function submitForm(Browser $browser, array $fields)
	{
		$this->fillTextFields($browser, array_filter($fields,[$this, "isTextField"]));
		$this->fillCheckBox($browser, array_filter($fields,[$this, "isCheckBox"]));
		$browser->click('button[type="submit"]');
	}

    /**
     *
     * @throws Throwable
     * @return void
     */
    public function test_restaurant_owner_can_update_their_own_restaurant_with_a_cuisine_type() :void
    {
        $this->browse(function (Browser $browser) {
            
            $this->setUpCuisines();
            
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);
            
            //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit');
	        $this->submitForm($browser,[
		        ['field_name' =>$cuisine1->name, 'field_value'=>null, 'field_type'=>'checkbox']
	        ]);
            // show
            $browser->assertSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('.cuisine-value','Not specified')
                    ->assertDontSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // index
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant1 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ->logout()
                    ;
        });
    }

	/**
	 * @throws Throwable
	 * @returns void
	 */
	public function test_restaurant_owner_can_update_their_own_restaurant_with_multiple_cuisine_type() :void
    {
        $this->browse(function (Browser $browser) {
            $this->setUpCuisines();
                
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit');
	        $this->submitForm($browser,[
		        ['field_name' =>$cuisine1->name, 'field_value'=>null, 'field_type'=>'checkbox'],
		        ['field_name' =>$cuisine2->name, 'field_value'=>null, 'field_type'=>'checkbox']
	        ]);

            //Show
            $browser->assertSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value','Not specified')
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // Index
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant1 .cuisine-value',$cuisine1->name)
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ->logout()
                    ;
        });
    }

	/**
	 * @throws Throwable
	 * @return void
	 */
	public function test_restaurant_owner_can_remove_a_cuisine_type_from_their_own_restaurant() :void
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->setUpCuisines();
                
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            //Link Restaurant & cuisine
            $restaurant2->cuisines()->attach([$cuisine1->id,$cuisine2->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit');
	        $this->submitForm($browser,[
		        ['field_name' =>$cuisine2->name, 'field_value'=>null, 'field_type'=>'checkbox']
	        ]);

            // Show
            $browser->assertSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('.cuisine-value','Not specified')
                    ->assertDontSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // Index
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant1 .cuisine-value',$cuisine1->name)
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
	public function test_restaurant_owner_can_remove_cuisine_types_from_their_own_restaurant() :void
    {
        $this->browse(function (Browser $browser) {
            //Cuisines
            $this->setUpCuisines();
                
            $cuisine1 = Cuisine::find(1);
            $cuisine2 = Cuisine::find(2);
            $cuisine3 = Cuisine::find(3);

	        //users
	        $user1 = factory(User::class)->create();

	        //restaurants
	        $restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
	        $restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

            //Link Restaurant & cuisine
            $restaurant2->cuisines()->attach([$cuisine1->id,$cuisine2->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit');
	        $this->submitForm($browser,[
		        ['field_name' =>$cuisine1->name, 'field_value'=>null, 'field_type'=>'checkbox'],
		        ['field_name' =>$cuisine2->name, 'field_value'=>null, 'field_type'=>'checkbox']
	        ]);

            // Show
            $browser->assertSeeIn('.cuisine-value','Not specified')
                    ->assertDontSeeIn('.cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
                    ->press('#view-restaurants')
                    // Index
                    ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
                    ->assertSeeIn('#restaurant2 .cuisine-value','Not specified')
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
                    ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
                    ->logout()
                    ;
        });
    }
}
