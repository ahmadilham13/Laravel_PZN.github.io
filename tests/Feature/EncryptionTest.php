<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $encrypt = Crypt::encrypt('Ahmad Ilham');
        var_dump($encrypt);
        $descrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Ahmad Ilham', $descrypt);
    }
}
