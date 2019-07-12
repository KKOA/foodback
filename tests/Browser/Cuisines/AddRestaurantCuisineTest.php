<?php
declare(strict_types=1);

namespace Tests\Browser\Cuisines;

use App\Models\Restaurant as Restaurant;
use App\Models\Cuisine as Cuisine;
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;


/**
 * Class AddRestaurantCuisineTest
 * @package Tests\Browser\cuisine
 */
class AddRestaurantCuisineTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
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
	 * @param User $user
	 */
	public function SetUpRestaurants(User $user)
    {
        //Create Cuisines
        Restaurant::create(
            [
                'user_id'       => $user->id,
            	'name'          => 'Benny',
                'description'   => 'Benny Text',
                'address1'      =>  '47 North Baliey',
                'city'          =>  'Durham',
                'postcode'      =>  'DH1 3ET'
            ]
        );
    }

    
    
    // public function test_user_can_see_restaurant_default_cuisine_type()
    // {
    //     $this->browse(function (Browser $browser) {
            
    //         $this->SetUpRestaurants();
    //         $browser->visit('/restaurants')
    //         //Index
    //         ->assertSeeIn('#restaurant1 .cuisine-value','Not specified');
    //     });

        
    // }

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
                    ->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('#'.$cuisine1->name)
                    ->click('button[type="submit"]')
                    //show
                    ->assertSeeIn('.cuisine-value',$cuisine1->name)
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
                    ->visit('/restaurants/create')
                    ->type('name', $restaurant2->name)
                    ->type('description',$restaurant2->description)
                    ->type('address1',$restaurant2->address1)
                    ->type('city',$restaurant2->city)
                    ->type('county',$restaurant2->county)
                    ->type('postcode',$restaurant2->postcode)
                    ->click('#'.$cuisine1->name)
                    ->click('#'.$cuisine2->name)
                    ->click('button[type="submit"]')
            //Show
            ->assertSeeIn('.cuisine-value',$cuisine1->name)
            ->assertSeeIn('.cuisine-value',$cuisine2->name)
            ->assertDontSeeIn('.cuisine-value',$cuisine3->name)
            ->press('#view-restaurants')
            // Index
            ->assertSeeIn('#restaurant1 .cuisine-value','Not specified')
            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine1->name)
            ->assertSeeIn('#restaurant2 .cuisine-value',$cuisine2->name)
            ->assertDontSeeIn('#restaurant2 .cuisine-value',$cuisine3->name)
            ->logout()
            ;
        });
    }
}
