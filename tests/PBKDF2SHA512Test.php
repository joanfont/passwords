<?php

use PHPUnit\Framework\TestCase;

use Passwords\Hasher;

class PBKDF2SHA512Test extends TestCase
{

  const SALT_123456 = 'd565ff778288da8a6ea5af0ebfbc6559';
  const HASH_123456 = '5c21518211a2aa3c4e0855ab923a5f968dffa14e0356a81ceb01545e98ce9d5c4e8063bb2f39e7e4194144f42c86d3dcccd7a55bfa878475b4af362681fa165b';
  const ITERATIONS = 1;

  public function test_hash_is_correct()
  {
    $hasher = new Hasher\PBKDF2SHA512(static::ITERATIONS);
    $hash = $hasher->encode('123456', static::SALT_123456);
    $this->assertEquals(static::HASH_123456, $hash);
  }

  public function test_hash_is_not_correct()
  {
    $hasher = new Hasher\PBKDF2SHA512(static::ITERATIONS);
    $hash = $hasher->encode('1234567', static::SALT_123456);
    $this->assertNotEquals(static::HASH_123456, $hash);
  }
}
