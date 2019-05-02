<?php

namespace Passwords\Hasher;


class Dummy extends Hasher
{
  const NAME = 'Dummy';

  public function encode(string $raw, ?string $salt, ?int $iteration = null): string
  {
    return $raw;
  }
}
