<?php

namespace Tests\Feature;

use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testNamedRedirect()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/John');
    }

    public function testActionRedirect()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/John');
    }

    public function testAwayRedirect()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://twitter.com/elonmusk');
    }
}
