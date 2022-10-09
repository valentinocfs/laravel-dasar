<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstname = config("contoh.author.name.first");
        $lastname = config('contoh.author.name.last');
        $email = config('contoh.email');

        self::assertEquals('John', $firstname);
        self::assertEquals('Doe', $lastname);
        self::assertEquals('johndoe@gmail.com', $email);
    }
}
