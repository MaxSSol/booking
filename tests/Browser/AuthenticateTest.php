<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_auth_profile_page_as_unauth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/profile')
                ->assertPathIs('/login')
                ->assertSee('Вхід');
        });
    }

    public function test_auth_reservation_page_as_unauth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reservation')
                ->assertPathIs('/login')
                ->assertSee('Вхід');
        });
    }

    public function test_auth_user_owner_page_as_unauth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/user/owner')
                ->assertPathIs('/login')
                ->assertSee('Вхід');
        });
    }
}
