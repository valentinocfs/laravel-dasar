<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.name.first')
            ->andReturn('John Doe');

        $firstname = Config::get('contoh.author.name.first');

        self::assertEquals('John Doe', $firstname);
    }
}
