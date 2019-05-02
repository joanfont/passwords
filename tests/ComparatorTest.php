<?php

use Passwords\Comparator;
use Passwords\HasherDetector;
use Passwords\Password;
use Passwords\Hasher;
use PHPUnit\Framework\TestCase;

class ComparatorTest extends TestCase
{

  public function test_passwords_are_equal()
  {
    $raw = 'test';
    $password = new Password(Hasher\Dummy::NAME, null, null, 'test');

    $detector = $this->getMockDetector();
    $comparator = new Comparator($detector);
    $are_equal = $comparator->compare($raw, $password);
    $this->assertTrue($are_equal);
  }

  public function test_passwords_are_different()
  {
    $raw = 'test1';
    $password = new Password(Hasher\Dummy::NAME, null, null, 'test');

    $detector = $this->getMockDetector();
    $comparator = new Comparator($detector);
    $are_equal = $comparator->compare($raw, $password);
    $this->assertFalse($are_equal);
  }

  private function getMockDetector()
  {
    $mock_detector = $this->prophesize(HasherDetector::class);
    $mock_detector->detectByPassword(Prophecy\Argument::any())->willReturn(new Hasher\Dummy());
    return $mock_detector->reveal();
  }
}
