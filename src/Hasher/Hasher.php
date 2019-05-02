<?php

namespace Passwords\Hasher;


abstract class Hasher
{
  protected const NAME = null;
  protected const WORK_FACTOR = null;

  abstract public function encode(string $raw, ?string $salt, ?int $iterations = null): string;

  public function getWorkFactor()
  {
    return static::WORK_FACTOR;
  }

  public function getAlgorithm()
  {
    return static::NAME;
  }
}
