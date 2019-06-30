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
 * Class RegisterTest
 * @package Tests\Browser\Auth
 */
class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DuskFormHelper;

	/**
	 * @param Browser $browser
	 * @param array $userDetails
	 * @return void
	 */
	public function submitRegisterForm(Browser $browser, array $userDetails) :void
	{
		$this->fillTextFields($browser, array_filter($userDetails,[$this, "isTextField"]));
		$browser->click('button[type="submit"]');
	}

    /**
     * A user can create an account.
     * @test
     * @throws Throwable
     * @return void
     */
    public function user_can_register_with_valid_details()
    {
        $this->browse(function (Browser $browser) {

            $user1 = new User();
            $user1->name = 'keith';
            $user1->email = 'keith@test.com';
            $user1->password = 'secret';

            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')

                ->waitFor('#nav-register')
                ->click('#nav-register')
                ->assertSee('Register');

	        $this->submitRegisterForm($browser,
		        [
			        ['field_name'=>'name',                  'field_value' =>$user1->name,       'field_type'=> 'text'],
			        ['field_name'=>'email',                 'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',              'field_value' =>$user1->password,   'field_type'=> 'password'],
			        ['field_name'=>'password_confirmation', 'field_value' =>$user1->password,   'field_type'=> 'password']
	            ]
	        );
            $browser->assertpathIs('/restaurants')
                ->assertSeeIn('#accountName',$user1->name)
                ->assertDontSeeIn('nav', 'Login')
                ->assertDontSeeIn('nav', 'Sign Up')
                ->logout();
        });
    }

     /**
     * Check user cannot create an account with invalid details
     * @test
      * @throws Throwable
      * @return void
     */
    public function user_cannot_register_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {

	        $user1 = new User();
	        $user1->name = 'al';
	        $user1->email = 'h@';
	        $user1->password = 'secret';

            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')
                ->click('#nav-register')
                ->assertSee('Register');

	        $this->submitRegisterForm($browser,
		        [
			        ['field_name'=>'name',                  'field_value' =>$user1->name,       'field_type'=> 'text'],
			        ['field_name'=>'email',                 'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',              'field_value' =>$user1->password,   'field_type'=> 'text'],
			        ['field_name'=>'password_confirmation', 'field_value' =>ucfirst($user1->password),   'field_type'=> 'text']
		        ]
	        );

                    //Assertion not written
            $browser->assertpathIs('/register')
	            ->assertSeeIn('#registerForm div:nth-child(2) .invalid-feedback-content','The name must be at least 3 characters.')
	            ->assertSeeIn('#registerForm div:nth-child(3) .invalid-feedback','The email must be a valid email address.')
	            ->assertSeeIn('#registerForm div:nth-child(4) .invalid-feedback-content', 'The password confirmation does not match.')
                ->clickLink('Account')
                ->assertDontSeeIn('nav', 'Login')
                ->assertDontSeeIn('nav', 'Sign Up');
        });
    }

    /**
     * Check user cannot create an account with exist account credentials
     * @test
     * @throws Throwable
     * @return void
     */
    public function user_cannot_register_an_account_with_exist_account_credentials()
    {
        $this->browse(function (Browser $browser) {
            $user1 = User::create(
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

	        $user2 = new User();
	        $user2->name = $user1->name;
	        $user2->email = $user1->email;
	        $user2->password = 'secret';

            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')
                ->click('#nav-register')
                ->assertSee('Register');

            $this->submitRegisterForm($browser,
                [
                    ['field_name'=>'name',                  'field_value' =>$user2->name,       'field_type'=> 'text'],
                    ['field_name'=>'email',                 'field_value' =>$user2->email,      'field_type'=> 'text'],
                    ['field_name'=>'password',              'field_value' =>$user2->password,   'field_type'=> 'text'],
                    ['field_name'=>'password_confirmation', 'field_value' =>ucfirst($user2->password),   'field_type'=> 'text']
                ]
            );

                    //Assertion not written
            $browser->assertpathIs('/register')
                ->assertSeeIn('#registerForm > div:nth-child(3) .invalid-feedback-content','The email has already been taken.')
                ->clickLink('Account')
                ->assertSeeIn('.main-nav', 'Login')
                ->assertSeeIn('.main-nav', 'Sign Up');
        });
    }
}
