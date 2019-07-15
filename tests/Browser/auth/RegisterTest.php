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
     * A user can create an account.
     * @test
     * @throws Throwable
     * @return void
     */
    public function user_can_register_with_valid_details() :void
    {
        $this->browse(function (Browser $browser) {

        	$user1= factory(User::class)->make();

//			die($user1);
            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')

                ->waitFor('#nav-register')
                ->click('#nav-register')
                ->assertSee('Register');

	        $this->submitForm($browser,
		        [
			        ['field_name'=>'first_name',            'field_value' =>$user1->first_name,       'field_type'=> 'text'],
			        ['field_name'=>'last_name',             'field_value' =>$user1->last_name,       'field_type'=> 'text'],
			        ['field_name'=>'username',             'field_value' =>$user1->username,       'field_type'=> 'text'],
			        ['field_name'=>'email',                 'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',              'field_value' =>$user1->password,   'field_type'=> 'password'],
			        ['field_name'=>'password_confirmation', 'field_value' =>$user1->password,   'field_type'=> 'password']
	            ]
	        );
            $browser->assertpathIs('/restaurants')
                ->assertSeeIn('#accountName',$user1->username)
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
    public function user_cannot_register_with_invalid_details() :void
    {
        $this->browse(function (Browser $browser) {

	        $user1= factory(User::class)->make([
	        	'first_name'=> 'al',
		        'last_name' => str_repeat('Number of times the input string should be repeated',15),
		        'username'  => 'al',
		        'email'     => 'h@',
		        'password'  => 'secret'
	        ]);

            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')
                ->click('#nav-register')
                ->assertSee('Register');

	        $this->submitForm($browser,
		        [
			        ['field_name'=>'first_name',                'field_value' =>$user1->first_name,       'field_type'=> 'text'],
			        ['field_name'=>'last_name',                 'field_value' =>$user1->last_name,       'field_type'=> 'text'],
			        ['field_name'=>'username',                  'field_value' =>$user1->username,       'field_type'=> 'text'],
			        ['field_name'=>'email',                     'field_value' =>$user1->email,      'field_type'=> 'text'],
			        ['field_name'=>'password',                  'field_value' =>$user1->password,   'field_type'=> 'text'],
			        ['field_name'=>'password_confirmation',     'field_value' =>ucfirst($user1->password),   'field_type'=> 'text']
		        ]
	        );
//			die($user1->last_name);
                    //Assertion not written
            $browser->assertpathIs('/register')
	            ->assertSeeIn('#registerForm div:nth-child(2) .invalid-feedback-content','The first name must be at least 3 characters.')
	            ->assertSeeIn('#registerForm div:nth-child(3) .invalid-feedback-content','The last name may not be greater than 255 characters.')
	            ->assertSeeIn('#registerForm div:nth-child(4) .invalid-feedback-content','The username must be at least 3 characters.')
	            ->assertSeeIn('#registerForm div:nth-child(5) .invalid-feedback','The email must be a valid email address.')
	            ->assertSeeIn('#registerForm div:nth-child(6) .invalid-feedback-content', 'The password confirmation does not match.')
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
    public function user_cannot_register_an_account_with_exist_account_credentials() :void
    {
        $this->browse(function (Browser $browser) {
	        $user1 = factory(User::class)->create();

	        $user2= factory(User::class)->make([
		        'username'=>$user1->username,
	        	'email'=>$user1->email,
		        'password'=>'secret'
	        ]);
	        /*
	        $user2 = new User();
	        $user2->name = $user1->name;
	        $user2->email = $user1->email;
	        $user2->password = 'secret';*/

            $browser->visit('/')
                // ->click('#accountDropdown')
                ->clickLink('Account')
                ->click('#nav-register')
                ->assertSee('Register');

            $this->submitForm($browser,
                [
                    ['field_name'=>'first_name',            'field_value' =>$user2->first_name,         'field_type'=> 'text'],
	                ['field_name'=>'last_name',             'field_value' =>$user2->last_name,          'field_type'=> 'text'],
	                ['field_name'=>'username',              'field_value' =>$user2->username,           'field_type'=> 'text'],
                    ['field_name'=>'email',                 'field_value' =>$user2->email,              'field_type'=> 'text'],
                    ['field_name'=>'password',              'field_value' =>$user2->password,           'field_type'=> 'text'],
                    ['field_name'=>'password_confirmation', 'field_value' =>ucfirst($user2->password),  'field_type'=> 'text']
                ]
            );

                    //Assertion not written
            $browser->assertpathIs('/register')
	            ->assertSeeIn('#registerForm > div:nth-child(4) .invalid-feedback-content','The username has already been taken.')
                ->assertSeeIn('#registerForm > div:nth-child(5) .invalid-feedback-content','The email has already been taken.')
                ->clickLink('Account')
                ->assertSeeIn('.main-nav', 'Login')
                ->assertSeeIn('.main-nav', 'Sign Up');
        });
    }
}
