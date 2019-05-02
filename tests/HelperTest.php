<?php

use Passwords\Comparator;
use Passwords\HasherFactory;
use Passwords\Helper;
use PHPUnit\Framework\TestCase;

use Passwords\Hasher;


class HelperTest extends TestCase
{
  protected function setUp(): void
  {
    parent::setUp();
    static::configureHelper();
  }

  public function test_check_passwords_are_equal()
  {
    $are_equal = Helper::check('test', 'Dummy$$$test');
    $this->assertTrue($are_equal);
  }

  public function test_makes_password()
  {
    $password = Helper::make('test', null);
    $this->assertEquals('Dummy$$$test', $password);
  }

  private function configureHelper()
  {
    Helper::registerHasher(new Hasher\Dummy);
  }
}
