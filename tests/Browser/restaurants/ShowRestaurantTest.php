<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant;
use App\Models\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Throwable;

/**
 * Class ShowRestaurantTest
 * @package Tests\Browser\Restaurants
 */
class ShowRestaurantTest extends DuskTestCase
{
	use DatabaseMigrations;

	/**
	 * Test guest can view restaurant
	 * @return void
	 * @throws Throwable
	 */
	public function test_guest_can_view_restaurant() :void
	{
		$this->browse(function (Browser $browser) {

			//users
			$user1 = factory(User::class)->create();

			//restaurants
			$restaurant1 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);
			$restaurant2 = factory(Restaurant::class)->create(['user_id'=>$user1->id]);

			$browser->visit('/restaurants/'.$restaurant1->id)
				->assertSee($restaurant1->name)
				->assertSee($restaurant1->description)
				->assertSee($restaurant1->fullAddress())
				->assertSeeIn('.cuisine-value','Not specified')
				->assertDontSee($restaurant2->name)
				->assertSeeLink('View Restaurant');
		});
	}
}
