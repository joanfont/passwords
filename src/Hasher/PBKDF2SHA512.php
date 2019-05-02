<?php

namespace Passwords\Hasher;


class PBKDF2SHA512 extends Hasher
{
  const NAME = 'PBKDF2SHA512';


  public function encode(string $raw, ?string $salt): string
  {
    return hash_pbkdf2(
      'sha512',
      $raw,
      $salt,
      $this->iterations()
    );
  }
}
