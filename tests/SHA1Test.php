<?php

use Passwords\Hasher;
use PHPUnit\Framework\TestCase;

class SHA1Test extends TestCase
{

  const SALT_123456 = 'd565ff778288da8a6ea5af0ebfbc6559';
  const HASH_123456 = 'fa7d490ff81cf11aa4a9541e9005caf8811aeeee';


  public function test_hash_is_correct()
  {
    $hasher = new Hasher\SHA1();
    $hash = $hasher->encode('123456', static::SALT_123456);
    $this->assertEquals(static::HASH_123456, $hash);
  }

  public function test_hash_is_not_correct()
  {
    $hasher = new Hasher\SHA1();
    $hash = $hasher->encode('1234567', static::SALT_123456);
    $this->assertNotEquals(static::HASH_123456, $hash);
  }
}
