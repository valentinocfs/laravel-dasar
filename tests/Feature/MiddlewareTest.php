<?php

namespace Tests\Feature;

use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    public function testInvalidMiddleware()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access Denied');
    }

    public function testValidMiddleware()
    {
        $this->withHeader('X-API-KEY', 'RAHASIA')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }

    public function testValidGroupMiddleware()
    {
        $this->withHeader('X-API-KEY', 'RAHASIA')
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText('GROUP');
    }
}
