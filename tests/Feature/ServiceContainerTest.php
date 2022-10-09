<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);

        // $this->app->bind(Person::class, function($app){
        //     return new Person(firstname : 'John', lastname: 'Doe');
        // }); // closure

        $this->app->singleton(Person::class, function($app){
            return new Person(firstname : 'John', lastname: 'Doe');
        }); // closure

        $person1 = $this->app->make(Person::class); // closure() -> new Person('..' , '..')
        $person2 = $this->app->make(Person::class); // closure() -> new Person('..' , '..')

        self::assertEquals('John', $person1->firstname);
        self::assertEquals('John', $person2->firstname);
        // self::assertNotSame($person1, $person2);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("John", "Doe");
        $this->app->instance(Person::class, $person); // instance

        $person1 = $this->app->make(Person::class); // object $person
        $person2 = $this->app->make(Person::class); // object $person

        self::assertEquals('John', $person1->firstname);
        self::assertEquals('John', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionClosure()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }
}
