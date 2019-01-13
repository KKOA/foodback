<?php

namespace Tests\Browser\auth;

//Models
use App\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test as a user can log in into their account.
     * @test
     * @return void
     */
    public function user_can_login()
    {
        $this->browse(function (Browser $browser) {

            //Need create user account
            $password = 'nisbets';
            $user1 = User::create(
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt($password)
                ]
            );

            $browser->visit('/')
                ->element('#accountDropdown')->click();
            $browser->element('#nav-login')->click();
            $this->submitLoginForm($browser,['email'=>$user1->email,'password'=> $password]);
            $browser->assertSeeIn('#accountName', $user1->name);
                //Success login message - not yet implement
            $browser->element('#accountDropdown')->click();
            $browser->assertDontSeeIn('.main-nav', 'Login')
                ->assertDontSeeIn('.main-nav', 'register')
                ->logout()
                ;
        });
    }

    /**
     * Test as a user cannot log in into their account with incorrect credentials.
     * @test
     * @return void
     */
    public function user_cannot_login_with_invalid_details()
    {

        $this->browse(function (Browser $browser) {
            $user1 = User::create(
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            $browser->visit('/')->element('#accountDropdown')->click();
            $browser->element('#nav-login')->click();
            $this->submitLoginForm($browser,['email'=>$user1->email,'password'=> 'secret']);
            $browser->assertSeeIn('form','These credentials do not match our records.');
            $browser->element('#accountDropdown')->click();
            $browser->assertSeeIn('.main-nav', 'Login')
                ->assertSeeIn('.main-nav', 'Sign Up')
                ->assertDontSeeIn('.main-nav', $user1->name)
                ;
        });
    }

    /**
     * fill the form with the second argument details
     * @return void
     */
    public function fillLoginForm(Browser $browser, $userDetails)
    {
        foreach($userDetails as $key => $value)
        {
            $browser->type($key,$value);
        }
    }

    /**
     * Passes the details to fillLoginForm and click submit button on the form
     * @return void
     */
    public function submitLoginForm(Browser $browser,$userDetails)
    {
        $this->fillLoginForm($browser,$userDetails);
        $browser->click('button[type="submit"]');
    }
}
