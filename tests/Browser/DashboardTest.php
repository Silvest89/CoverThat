<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoginLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard/login')
                    ->type('email', 'test@test.nl')
                    ->type('password', 'test')
                    ->press('Login')
                    ->assertPathIs('/dashboard/home')
                    ->clickLink('Logout')
                    ->assertPathIs('/dashboard/login');
        });
    }
}
