<?php

use Passwords\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
  public function test_generates_password_by_raw_value()
  {
    $password = Password::fromRawValue('Dummy$1$salt$test');
    $this->assertEquals('Dummy', $password->algorithm());
    $this->assertEquals('1', $password->iterations());
    $this->assertEquals('salt', $password->salt());
    $this->assertEquals('test', $password->hash());
  }
}
