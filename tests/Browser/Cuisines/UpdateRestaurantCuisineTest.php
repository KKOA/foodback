<?php
declare(strict_types=1);
namespace Tests\Browser\Cuisines;

use App\Models\Restaurant;
use App\Models\Cuisine;
use App\Models\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;


/**
 * Class UpdateRestaurantCuisineTest
 * @package Tests\Browser\Cuisines
 */
class UpdateRestaurantCuisineTest extends DuskTestCase
{
    use DatabaseMigrations;

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
	 * @param User $user
	 * @return void
	 */
	public function SetUpRestaurants(User $user) :void
    {
        //Create Cuisines
        Restaurant::create(
            [
            	'user_id'       =>$user->id,
                'name'          => 'Benny',
                'description'   => 'Benny Text',
                'address1'      =>  '47 North Baliey',
                'city'          =>  'Durham',
                'postcode'      =>  'DH1 3ET'
            ]
        );
        Restaurant::create(
            [
	            'user_id'       =>$user->id,
            	'name'          =>  'bebo',
                'description'   =>  'some random text',
                'address1'      =>  '28 Church Road',
                'city'          =>  'Hove',
                'county'        =>  'East Sussex',
                'postcode'      =>  'BN3 2FN'
            ]
        );
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
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );
            $this->SetUpRestaurants($user1);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit')
                    ->click('#'.$cuisine1->name)
                    ->click('button[type="submit"]')
                    // show
                    ->assertSeeIn('.cuisine-value',$cuisine1->name)
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
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            $this->SetUpRestaurants($user1);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit')
                    ->click('#'.$cuisine1->name)
                    ->click('#'.$cuisine2->name)
                    ->click('button[type="submit"]')
                    //Show
                    ->assertSeeIn('.cuisine-value',$cuisine1->name)
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
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            //Restaurants
            $this->SetUpRestaurants($user1);
            $restaurant2 = Restaurant::find(2);

            //Link Restaurant & cuisine
            $restaurant2->cuisines()->attach([$cuisine1->id,$cuisine2->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit')
                    ->click('#'.$cuisine2->name)
                    ->click('button[type="submit"]')
                    // Show
                    ->assertSeeIn('.cuisine-value',$cuisine1->name)
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
            $user1 = User::firstOrCreate(
                ['name'          =>  'Keith'],
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            //Restaurants
            $this->SetUpRestaurants($user1);
            $restaurant2 = Restaurant::find(2);

            //Link Restaurant & cuisine
            $restaurant2->cuisines()->attach([$cuisine1->id,$cuisine2->id]);

            $browser->loginAs($user1)
                    ->visit('/restaurants/2/edit')
                    ->click('#'.$cuisine1->name)
                    ->click('#'.$cuisine2->name)
                    ->click('button[type="submit"]')
                    // Show
                    ->assertSeeIn('.cuisine-value','Not specified')
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
