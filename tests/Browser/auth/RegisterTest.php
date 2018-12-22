<?php

namespace Tests\Browser\auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;


        /**
     * A user can create an account.
     * @test
     * @return void
     */
    public function user_can_register_with_valid_details()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name','keith')
                    ->type('email','keith@test.com')
                    ->type('password','secret')
                    ->type('password_confirmation','secret')
                    ->click('button[type="submit"]')
                    ->assertpathIs('/home')
                    ->assertDontSeeIn('nav', 'Login')
                    ->assertDontSeeIn('nav', 'Sign Up')
                    ->logout()
                    ;
        });
    }

     /**
     * Check user cannot create an account with invalid details
     * @test
     * @return void
     */
    public function user_cannot_register_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name','al')
                    ->type('email','h@t')
                    ->type('password','secret')
                    ->type('password_confirmation','Secret')
                    ->click('button[type="submit"]')
                     //Assertion not written
                    ->assertpathIs('/register')
                    ->assertSeeIn('#registerForm > div:nth-child(2) .invalid-feedback-content','The name must be at least 3 characters.')
                    ->assertSeeIn('#registerForm > div:nth-child(3) .invalid-feedback-content','The email must be a valid email address.')
                    ->assertSeeIn('#registerForm > div:nth-child(4) .invalid-feedback-content',
                    'The password confirmation does not match.')
                    ->assertDontSee('nav', 'Login')
                    ->assertDontSee('nav', 'Sign Up')
                    ;

        });
    }

    /**
     * Check user cannot create an account with exist account credintials
     * @test
     * @return void
     */
    public function user_cannot_register_an_account_with_exist_account_credintials()
    {
        $this->browse(function (Browser $browser) {
            $user1 = User::create(
                [
                    'name'          =>  'Keith',
                    'email'         => 'keith@test.com',
                    'password'  =>  bcrypt('nisbets')
                ]
            );

            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name',$user1->name)
                    ->type('email',$user1->email)
                    ->type('password','secret')
                    ->type('password_confirmation','secret')
                    ->click('button[type="submit"]')
                     //Assertion not written
                    ->assertSeeIn('form','The email has already been taken.')
                    ->assertSeeIn('nav', 'Login')
                    ->assertSeeIn('nav', 'Sign Up')
                    ->assertpathIs('/register')
                    ;
        });
    }
}
