<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText("Ok")
            ->assertSessionHas('username', 'ilham13')
            ->assertSessionHas('is-Member', 'true');
    }
    public function testGetSession()
    {
        $this->withSession([
            'username' => 'ilham13',
            'is-Member' => 'true'
        ])->get ('session/get')
          ->assertSeeText('Username : ilham13, Is Member : true');
    }
    public function testGetSessionGuest()
    {
        $this->withSession([])->get ('session/get')
          ->assertSeeText('Username : guest, Is Member : false');
    }
}
