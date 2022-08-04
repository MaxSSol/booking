<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_registration_page_with_wrong_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/registration')
                ->press('Зареєструватися')
                ->assertSee('Обов\'язкове для заповнення');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_registration_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/registration')
                ->type('#email', 'test@email.com')
                ->type('#first_name', 'Maks')
                ->type('#password', 'Pa$$w0rd!')
                ->type('#password_confirmation', 'Pa$$w0rd!')
                ->press('Зареєструватися')
                ->pause(1000)
                ->assertSee('Maks');
        });
    }
}
