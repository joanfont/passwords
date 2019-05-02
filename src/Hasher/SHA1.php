<?php

namespace Passwords\Hasher;


class SHA1 extends Hasher
{
  const NAME = 'SHA1';

  public function encode(string $raw, ?string $salt): string
  {
    return sha1($salt . $raw);
  }
}
