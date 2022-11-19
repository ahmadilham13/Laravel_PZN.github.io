<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstname1 = config('contoh.author.first');
        $firstname2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstname3 = $config->get('contoh.author.first');

        $firstname1 = config('contoh.author.first');
        $firstname2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
        self::assertEquals($firstname1, $firstname3);
        var_dump($config->all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn('Ahmad Keren');

        $firstName = Config::get('contoh.author.first');
        self::assertEquals("Ahmad Keren", $firstName);

    }
}
