<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("Hello Ahmad Ilham");
    }
    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }
    public function testFallback()
    {
        $this->get('/tidakAda')
            ->assertSeeText("404 By Ahmad Ilham");
    }

    public function testRouteParameter()
    {
        $this->get('products/1')
            ->assertSeeText("Product : 1");

        $this->get('products/2')
            ->assertSeeText("Product : 2");

        $this->get('/products/1/item/1')
            ->assertSeeText("Product : 1, Item : 1");
    }

    public function testParameterRegex()
    {
        $this->get('/kategori/100')
            ->assertSeeText('Kategori : 100');

        $this->get('kategori/ilham')
            ->assertSeeText('404 By Ahmad Ilham');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/')
            ->assertSeeText('User : 404');

        $this->get('users/ilham')
            ->assertSeeText("User : ilham");
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link : http://localhost/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}
