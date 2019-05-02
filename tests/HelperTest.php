<?php

use Passwords\Comparator;
use Passwords\HasherDetector;
use Passwords\Helper;
use PHPUnit\Framework\TestCase;

use Passwords\Hasher;


class HelperTest extends TestCase
{

  public function test_check_passwords_are_equal()
  {
    $are_equal = $this->getHelper()->check('test', 'Dummy$$$test');
    $this->assertTrue($are_equal);
  }

  public function test_makes_password()
  {
    $password = $this->getHelper()->make('test', null, Hasher\Dummy::class);
    $this->assertEquals('Dummy$$$test', $password);
  }

  private function getHelper()
  {
    $detector = new HasherDetector([Hasher\Dummy::class]);
    $comparator = new Comparator($detector);

    return new Helper($detector, $comparator);
  }
}
