<?php
declare(strict_types=1);

namespace Tests\Browser\Auth;

//Models
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;
use Tests\Browser\MyHelper\DuskFormHelper;


/**
 * Class LoginTest
 * @package Tests\Browser\Auth
 */
class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
	use DuskFormHelper;

	/**
	 * Passes the details to fillLoginForm and click submit button on the form
	 * @param Browser $browser
	 * @param array $userDetails
	 * @return void
	 */
	public function submitLoginForm(Browser $browser,array $userDetails) :void
	{
		$this->fillTextFields($browser, array_filter($userDetails,[$this, "isTextField"]));
		$browser->click('button[type="submit"]');
	}


    /**
     * Test as a user can log in into their account.
     * @test
     * @throws Throwable
     * @return void
     */
    public function user_can_login() :void
    {
        $this->withExceptionHandling();
    	$this->browse(function (Browser $browser) {

            //Need create user account
            $password = 'nisbets';

		    $user1 = factory(User::class)->create([
			    'password'  =>  bcrypt($password)
		    ]);

            $browser->visit('/')
                    ->element('#accountDropdown')->click();
            $browser->element('#nav-login')->click();

	        $this->submitLoginForm($browser,
		        [
			        ['field_name'=>'email',                 'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',              'field_value' =>$password,   'field_type'=> 'password']

		        ]
	        );

            $browser->assertSeeIn('#accountName', $user1->name);
                //Success login message - not yet implement
            $browser->element('#accountDropdown')->click();
            $browser->assertDontSeeIn('.main-nav', 'Login')
                    ->assertDontSeeIn('.main-nav', 'register')
                    ->logout();
        });
    }

    /**
     * Test as a user cannot log in into their account with incorrect credentials.
     * @test
     * @throws Throwable
     * @return void
     */
    public function user_cannot_login_with_invalid_details() :void
    {

        $this->browse(function (Browser $browser) {
	        $password = "nisbets";

        	$user1 = factory(User::class)->create([
		        'password'  =>  bcrypt($password)
	        ]);

            $browser->visit('/')->element('#accountDropdown')->click();
            $browser->element('#nav-login')->click();

	        $this->submitLoginForm($browser,
		        [
			        ['field_name'=>'email',                 'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',              'field_value' =>'secret',   'field_type'=> 'password']

		        ]
	        );

	        $browser->assertSeeIn('form','These credentials do not match our records.');
            $browser->element('#accountDropdown')->click();
            $browser->assertSeeIn('.main-nav', 'Login')
	                ->assertSeeIn('.main-nav', 'Sign Up')
                    ->assertDontSeeIn('.main-nav', $user1->name);
        });
    }
}
