<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/john')
            ->assertStatus(200)
            ->assertSeeText('Hello John');
    }

    public function testRedirect()
    {
        $this->get('/user')
            ->assertRedirect('/john');
    }

    public function testFallback()
    {
        $this->get('/ ')
            ->assertSeeText('404');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/item/xxx')
        ->assertSeeText('Product 1 Item xxx');

        $this->get('/products/2/item/yyy')
        ->assertSeeText('Product 2 Item yyy');
    }

    public function testRouteParamRegex()
    {
        $this->get('/category/5')
            ->assertSeeText('Category 5');

        $this->get('/category/xxx')
            ->assertSeeText('404');
    }

    public function testRouteParamOptional()
    {
        $this->get('/users/123')
            ->assertSeeText('User 123');

        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get("/conflict/jane")
            ->assertSeeText('Conflict jane');

        $this->get("/conflict/john")
            ->assertSeeText('Conflict john');
    }
}
