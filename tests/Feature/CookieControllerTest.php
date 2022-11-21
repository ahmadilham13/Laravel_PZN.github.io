<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText(('Hello Cookie'))
            ->assertCookie('username', 'ilham13')
            ->assertCookie('is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('username', 'ilham13')
             ->withCookie('is-Member', 'true')
             ->get('/cookie/get')
             ->assertJson([
                'username' => 'ilham13',
                'is-Member'=> 'true'
             ]);
    }
    public function testClearCookie()
    {
        $this->get('/cookie/clear')
            ->assertSeeText('Clear Cookie')
            ->assertCookie('username')
            ->assertCookie('is-Member');
    }
}
