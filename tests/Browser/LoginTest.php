<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_login_page_with_wrong_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('#email', 'test@user.com')
                ->type('#password', 'password')
                ->press('Увійти')
                ->pause(2000)
                ->assertSee('Перевірте надані дані');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_login_page()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->press('Увійти')
                ->pause(2000)
                ->assertSee($user->first_name);
        });
    }
}
