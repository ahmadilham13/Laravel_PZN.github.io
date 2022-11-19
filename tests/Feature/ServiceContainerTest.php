<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new foo
        $foo2 = $this->app->make(Foo::class); // new foo2

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
    }  
    public function testBind()
    {
        $this->app->bind(Person::class, function($app) {
            return new Person("Ahmad", "Ilham");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
    
        self::assertEquals('Ahmad', $person1->firstName);
        self::assertEquals('Ahmad', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }
    public function testSingleton()
    {
        $this->app->singleton(Person::class, function($app) {
            return new Person("Ahmad", "Ilham");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
    
        self::assertEquals('Ahmad', $person1->firstName);
        self::assertEquals('Ahmad', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testInstance()
    {
        $person = new Person("Ahmad", "Ilham");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
    
        self::assertEquals('Ahmad', $person1->firstName);
        self::assertEquals('Ahmad', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }
    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            $foo = $this->app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Hello Ilham", $helloService->hello("Ilham"));
    }
}
