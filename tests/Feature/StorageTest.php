<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class StorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk('local');

        $filesystem->put('file.txt', 'John F Khannedy');

        $content = $filesystem->get('file.txt');

        assertEquals('John F Khannedy', $content);
    }

    public function testLinkStorage()
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', 'John Doe');

        $content = $filesystem->get('file.txt');

        assertEquals('John Doe', $content);
    }
}
