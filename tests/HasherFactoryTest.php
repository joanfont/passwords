<?php

use Passwords\Exception;
use Passwords\Hasher;
use Passwords\HasherFactory;
use Passwords\Password;
use PHPUnit\Framework\TestCase;

class HasherFactoryTest extends TestCase
{
  public function test_detects_allowed_hash_by_password()
  {
    $factory = new HasherFactory([Hasher\Dummy::NAME => Hasher\Dummy::class]);
    $allowed_password = new Password(Hasher\Dummy::NAME, null, null, 'test');

    $hasher = $factory->makeFromPassword($allowed_password);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_password()
  {
    $factory = new HasherFactory([]);
    $allowed_password = new Password(Hasher\Dummy::NAME, null, '', 'test');

    $this->expectException(Exception\UnknownAlgorithm::class);
    $factory->makeFromPassword($allowed_password);
  }

  public function test_detects_allowed_hash_by_algorithm()
  {
    $factory = new HasherFactory([Hasher\Dummy::NAME => Hasher\Dummy::class]);

    $hasher = $factory->makeFromAlgorithm(Hasher\Dummy::NAME);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_algorithm()
  {
    $detector = new HasherFactory([]);

    $this->expectException(Exception\UnknownAlgorithm::class);
    $detector->makeFromAlgorithm(Hasher\Dummy::NAME);
  }

  public function test_detects_allowed_hash_by_hasher()
  {
    $detector = new HasherFactory([Hasher\Dummy::NAME => Hasher\Dummy::class]);

    $hasher = $detector->makeFromHasherClass(Hasher\Dummy::class);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_hasher()
  {
    $detector = new HasherFactory([]);

    $this->expectException(Exception\UnknownAlgorithm::class);
    $detector->makeFromHasherClass(Hasher\Dummy::class);
  }
}
