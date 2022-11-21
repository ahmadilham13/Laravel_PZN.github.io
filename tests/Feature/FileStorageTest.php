<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk('local');
        
        $filesystem->put('file.txt', 'Ahmad Ilham File');

        $content = $filesystem->get('file.txt');

        self::assertEquals('Ahmad Ilham File', $content);
    }
    public function testPublic()
    {
        $filesystem = Storage::disk('public');
        
        $filesystem->put('file.txt', 'Ahmad Ilham File Public');

        $content = $filesystem->get('file.txt');

        self::assertEquals('Ahmad Ilham File Public', $content);
    }    
}
