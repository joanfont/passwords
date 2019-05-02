<?php

namespace Passwords\Hasher;


abstract class Hasher
{
  const NAME = null;

  protected $iterations;

  public final function __construct(?int $iterations = null)
  {
    $this->iterations = $iterations;
  }

  abstract public function encode(string $raw, ?string $salt): string;

  public final function algorithm()
  {
    return static::NAME;
  }

  public function iterations()
  {
    return $this->iterations;
  }
}
