<?php

namespace Tests\Feature;

use Tests\TestCase;

class CookieTest extends TestCase
{
    public function testCreateCookie()
    {
          $this->get('/cookie/set')
            ->assertCookie('User-Id', 'john')
            ->assertCookie('Is-Member', 'true')
            ->assertCookieNotExpired('User-Id');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'john')
            ->withCookie('Is-Member', 'true')
            ->get('cookie/get')
            ->assertJson([
                'userId' => 'john',
                'isMember' => 'true'
            ]);
    }

    public function testClearCookie()
    {
        $this->get('cookie/get')
        ->assertJson([
            'userId' => 'guest',
            'isMember' => 'false'
        ]);
    }
}
