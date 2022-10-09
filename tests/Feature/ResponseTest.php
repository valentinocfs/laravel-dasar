<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText('Hello Response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('John')->assertSeeText('Doe')
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'John Freddy Doe')
        ->assertHeader('App', 'Laravel Dasar');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('John Doe');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson(['firstname' => 'John', 'lastname' => 'Doe']);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            // ->assertHeader('Content-Type', 'image/png');
            ->assertStatus(200);
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('default.png');
    }
}
