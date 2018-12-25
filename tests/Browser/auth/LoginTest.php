<?php

namespace Tests\Browser\auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User as User;

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
            $user1 = User::create(
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            $browser->visit('/')
                ->click('#nav-login')
                ->type('email',$user1->email)
                ->type('password','nisbets')
                ->click('button[type="submit"]')
                ->assertSeeIn('#accountName', $user1->name)
                //Success login message - not yet implement
                ->assertDontSeeIn('nav', 'Login')
                ->assertDontSeeIn('nav', 'register')
                ->logout()
                ;
        });
    }

    /**
     * Test as a user cannot log in into their account with incorrect credintials.
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

            $browser->visit('/')
                ->click('#nav-login')
                ->type('email',$user1->email)
                ->type('password','secret')
                ->click('button[type="submit"]')
                ->assertSeeIn('form','These credentials do not match our records.')
                ->assertSeeIn('nav', 'Login')
                ->assertSeeIn('nav', 'Sign Up')
                ->assertDontSeeIn('nav', $user1->name)
                //Error message - not yet implement
                //Assertion not written
                ;
        });
    }
}
