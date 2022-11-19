<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello Ahmad Ilham1");

        $this->get('/hello-again')
            ->assertSeeText("Hello Ahmad Ilham2");
    }
    public function testNasted()
    {
        $this->get('/hello-world')
            ->assertSeeText("Hello Ilham Ahmad");
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Ilham'])
            ->assertSeeText('Hello Ilham');
        $this->view('hello.world', ['name' => 'Ahmad Ilham'])
            ->assertSeeText('Hello Ahmad Ilham');
    }
}
