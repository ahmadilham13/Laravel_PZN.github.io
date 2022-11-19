<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Ilham')
            ->assertSeeText('Hallo Ilham');
        $this->post('/input/hello', [
            'name' => 'Ilham'
        ])->assertSeeText('Hallo Ilham');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => [
            'first' => "Ahmad",
            "last" => "Ilham"
        ]])->assertSeeText('Hallo Ahmad');
    }
    public function testInputAll()
    {
        $this->post('/input/hello/input', ['name' => [
            'first' => "Ahmad",
            "last" => "Ilham"
        ]])->assertSeeText('name')->assertSeeText('first')->assertSeeText('last')->assertSeeText('Ahmad')->assertSeeText('Ilham');
    }
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple MacBook Pro 1",
                    "price" => 20000000
                ],
                [
                    "name" => "Samsung Galaxy 10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple MacBook Pro 1")
        ->assertSeeText("Samsung Galaxy 10");
    }
}
