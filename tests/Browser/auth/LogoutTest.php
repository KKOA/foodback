<?php
declare(strict_types=1);

namespace Tests\Browser\Auth;

//Models
use App\Models\User as User;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;


/**
 * Class LogoutTest
 * @package Tests\Browser\Auth
 */
class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * Test a login user can logout of their account
     *  @test
     * @throws Throwable
     * @return void
     */
    public function user_can_logout_of_their_account()
    {
        $this->browse(function (Browser $browser) {

	        $user1 = factory(User::class)->create();
            
            $browser->loginAs($user1);
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
