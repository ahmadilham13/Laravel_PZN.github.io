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

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => "Tono",
            'married' => true,
            'birth_date' => '1999-05-13'
        ])->assertSeeText('Tono')->assertSeeText('true')->assertSeeText('1999-05-13');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name'=> [
                'first' => 'Ahmad',
                'middle' => 'Tono',
                'last' => 'Ilham'
            ]
            ])->assertSeeText('Ahmad')->assertSeeText('Ilham')->assertDontSeeText('middle');
    }
    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username'=> 'ilham_13',
            'admin' => true,
            'password' => 'rahasia' 
            ])->assertSeeText('ilham_13')->assertSeeText('rahasia')->assertDontSeeText('admin');
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'username'=> 'ilham_13',
            'admin' => true,
            'password' => 'rahasia' 
            ])->assertSeeText('ilham_13')->assertSeeText('rahasia')->asserSeeText('admin')->assertSeeText('false');
    }
}
