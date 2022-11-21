<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }
    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Ahmad')->assertSeeText('Ilham')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Programmer')
            ->assertHeader('App', 'Belajar Laravel');
    }
    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Ilham');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName'=> 'Ahmad',
                'lastName' => 'Ilham'
            ]);
    }
    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('ilham.png');
    }
}
