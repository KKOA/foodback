<?php

namespace Tests\Browser\Restaurants;

//Models
use App\Models\Restaurant;
use App\Models\User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Throwable;

class ShowRestaurantTest extends DuskTestCase
{
	use DatabaseMigrations;

	/**
	 * Test guest can view restaurant
	 *
	 * @return void
	 * @throws Throwable
	 */
	public function test_guest_can_view_restaurant() :void
	{
		$this->browse(function (Browser $browser) {

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
					'user_id'       => $user1->id,
					'name'          =>  'Nur',
					'description'   =>  'Nur text',
					'address1'      =>  '22 Bridge Street',
					'address2'      =>  '',
					'city'          =>  'Glasgow',
					'county'        =>  '',
					'postcode'      =>  'G5 9HR'
				]
			);

			$restaurant2 = Restaurant::create(
				[
					'user_id'       => $user1->id,
					'name'          =>  'Thai Garden',
					'description'   =>  'Thai Garden text',
					'address1'      =>  '100 West Street',
					'address2'      =>  '',
					'city'          =>  'Bristol',
					'county'        =>  '',
					'postcode'      =>  'BS3 3LR'
				]
			);

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
