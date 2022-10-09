<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $encrypt = Crypt::encrypt('johndoe123');
        var_dump($encrypt);

        $decrypt = Crypt::decrypt($encrypt);
        var_dump($decrypt);

        self::assertEquals('johndoe123', $decrypt);
    }
}
