<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello John');

        $this->get('/hello-again')
            ->assertSeeText('Hello John');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World John');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'John'])
            ->assertSeeText("Hello John");
    }
}
