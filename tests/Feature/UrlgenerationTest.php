<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlgenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Ilham')
            ->assertSeeText('/url/current?name=Ilham');
    }
    public function testNamed()
    {
        $this->get('redirect/named')
            ->assertSeeText('/redirect/hello/Ilham3/Jambi3');
    }
    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
