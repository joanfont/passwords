<?php

use Passwords\HasherDetector;
use Passwords\Password;
use PHPUnit\Framework\TestCase;
use Passwords\Hasher;
use Passwords\Exception;

class HasherDetectorTest extends TestCase
{
  public function test_detects_allowed_hash_by_password()
  {
    $detector = new HasherDetector([Hasher\Dummy::class]);
    $allowed_password = new Password(Hasher\Dummy::NAME, null, null, 'test');
    $hasher = $detector->detectByPassword($allowed_password);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_password()
  {
    $this->expectException(Exception\UnknownAlgorithm::class);
    $detector = new HasherDetector([]);
    $allowed_password = new Password(Hasher\Dummy::NAME, null, '', 'test');
    $detector->detectByPassword($allowed_password);
  }

  public function test_detects_allowed_hash_by_algorithm()
  {
    $detector = new HasherDetector([Hasher\Dummy::class]);
    $hasher = $detector->detectByAlgorithm(Hasher\Dummy::NAME);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_algorithm()
  {
    $this->expectException(Exception\UnknownAlgorithm::class);
    $detector = new HasherDetector([]);
    $detector->detectByAlgorithm(Hasher\Dummy::NAME);
  }

  public function test_detects_allowed_hash_by_hasher()
  {
    $detector = new HasherDetector([Hasher\Dummy::class]);
    $hasher = $detector->detectByHasher(Hasher\Dummy::class);

    $this->assertInstanceOf(Hasher\Dummy::class, $hasher);
  }

  public function test_detects_not_allowed_hash_by_hasher()
  {
    $this->expectException(Exception\UnknownAlgorithm::class);
    $detector = new HasherDetector([]);
    $detector->detectByHasher(Hasher\Dummy::class);
  }
}
