<?php

namespace Tests\Browser\auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User as User;

class LogoutTest extends DuskTestCase
{
    /**
     * Test a login user can logout of their account
     *  @test
     * @return void
     */
    public function user_can_logout_of_their_account()
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
            
            $browser->loginAs(User::find(1));
            $browser->visit('/');
            $browser->assertSeeIn('#accountDropdown', $user1->name);
            $browser->element('#accountDropdown')->click();
            $browser->element('#nav-logout')->click();
            $browser->element('#logout-btn')->click();
            $browser->assertDontSeeIn('#accountDropdown', $user1->name);
            $browser->element('#accountDropdown')->click();
            $browser->assertSeeIn('.main-nav', 'Login')
                    ->assertSeeIn('.main-nav', 'Sign Up');
            // $browser->logout();
        });
    }
}
