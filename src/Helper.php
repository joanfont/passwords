<?php

namespace Passwords;

class Helper
{
  private $detector;

  private $comparator;

  public function __construct(
    HasherDetector $detector,
    Comparator $comparator
  ) {
    $this->detector = $detector;
    $this->comparator = $comparator;
  }

  public function check(string $raw, string $encoded): bool
  {
    $password = Password::fromRawValue($encoded);
    return $this->comparator->compare($raw, $password);
  }

  public function make(string $raw, ?string $salt, string $hasher): string
  {
    $hasher = $this->detector->detectByHasher($hasher);
    $hash = $hasher->encode($raw, $salt);

    $password = new Password(
      $hasher->getAlgorithm(),
      $hasher->getWorkFactor(),
      $salt,
      $hash
    );

    return (string) $password;
  }
}
