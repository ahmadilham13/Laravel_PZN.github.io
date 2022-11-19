<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvirontmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('Ahmad Ilham', $youtube);
    }
    public function testDefaultEnv()
    {
        $author = Env::get('AUTHOR', 'Ilham');

        self::assertEquals('Ilham', $author);
    }
}
