<?php

namespace Passwords\Hasher;


class PBKDF2SHA512 extends Hasher
{
  protected const NAME = 'PBKDF2SHA512';
  protected const WORK_FACTOR = 1000;

  protected const HASH_ALGORITHM = 'sha512';

  public function encode(string $raw, ?string $salt, ?int $iteration = null): string
  {
    if (!$iteration) {
      $iteration = $this->getWorkFactor();
    }

    return hash_pbkdf2(
      static::HASH_ALGORITHM,
      $raw,
      $salt,
      $iteration
    );
  }
}
