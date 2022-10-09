<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=John')
            ->assertSeeText('Hello John');

        $this->post('/input/hello',
            ['name' => 'John']
        )->assertSeeText('Hello John');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ]
        ])->assertSeeText('Hello John');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('last')
            ->assertSeeText('John')
            ->assertSeeText('Doe');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Samsung',
                    'categoy' => 'Handphone'
                ],
                [
                    'name' => 'Iphone',
                    'category' => 'Handphone'
                ],
                [
                    'name' => 'Vivo',
                    'category' => 'Handphone'
                ]
            ]
        ])->assertSeeText('Samsung')
            ->assertSeeText('Iphone')
            ->assertSeeText('Vivo');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'John',
            'married' => 'false',
            'birth_date' => '1999-10-10'
        ])->assertSeeText('John')
            ->assertSeeText('false')
            ->assertSeeText('1999-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'John',
                'middle' => 'Freddy',
                'last' => 'Doe'
            ]
        ])->assertSeeText('John')
            ->assertSeeText('Doe')
            ->assertDontSeeText('Freddy');
    }


    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username' => 'john',
            'password' => 'john123',
            'admin' => 'true'
        ])->assertSeeText('john')
            ->assertSeeText('john123')
            ->assertDontSeeText('admin');
    }

    public function testMergeInput()
    {
        $this->post('/input/merge', [
            'username' => 'john',
            'password' => 'john123',
            'admin' => 'true'
        ])->assertSeeText('john')
            ->assertSeeText('john123')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}
