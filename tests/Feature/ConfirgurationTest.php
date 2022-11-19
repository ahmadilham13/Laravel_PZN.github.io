<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfirgurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Ahmad', $firstName);
        self::assertEquals('Ilham2', $lastName);
        self::assertEquals('ahmad13ilham13@gmail.com', $email);
        self::assertEquals('https://www.ilham.com', $web);
    }
}
