<?php

use Passwords\Comparator;
use Passwords\Hasher;
use Passwords\HasherFactory;
use Passwords\Password;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class ComparatorTest extends TestCase
{

  public function test_passwords_are_equal()
  {
    $raw = 'test';
    $password = new Password(Hasher\Dummy::NAME, null, null, 'test');

    $factory = $this->getFactoryMock();
    $comparator = new Comparator($factory);
    $are_equal = $comparator->compare($raw, $password);
    $this->assertTrue($are_equal);
  }

  public function test_passwords_are_different()
  {
    $raw = 'test1';
    $password = new Password(Hasher\Dummy::NAME, null, null, 'test');

    $detector = $this->getFactoryMock();
    $comparator = new Comparator($detector);
    $are_equal = $comparator->compare($raw, $password);
    $this->assertFalse($are_equal);
  }

  private function getFactoryMock()
  {
    $factory_prophet = $this->prophesize(HasherFactory::class);
    $factory_prophet->makeFromPassword(Argument::any())->willReturn(new Hasher\Dummy());
    return $factory_prophet->reveal();
  }
}
