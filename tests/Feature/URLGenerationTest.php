<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testGetUrlCurrent()
    {
        $this->get('/url/current?name=John')
            ->assertSeeText('John');
    }

    public function testNamedRoutes()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/John');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
