<?php

namespace Passwords;

use Passwords\Hasher\Hasher;

class HasherFactory
{
  private $available_algorithms;

  public function __construct(array $available_algorithms)
  {
    $this->available_algorithms = $available_algorithms;
  }

  public function makeFromPassword(Password $password): Hasher
  {
    $algorithm = $password->algorithm();
    $iterations = $password->iterations();
    return $this->getHasherInstance($algorithm, $iterations);
  }

  public function makeFromAlgorithm(string $algorithm, ?int $iterations = null): Hasher
  {
    return $this->getHasherInstance($algorithm, $iterations);
  }

  public function makeFromHasherClass(string $hasher_class, ?int $iterations = null): Hasher
  {
    $hasher_instance = new $hasher_class;
    return $this->getHasherInstance($hasher_instance::NAME, $iterations);
  }

  private function getHasherInstance(?string $algorithm, ?int $iterations = null): Hasher
  {
    if (!array_key_exists($algorithm, $this->available_algorithms)) {
      throw new Exception\UnknownAlgorithm("Algorithm {$algorithm} not in known algorithms list");
    }

    $hasher_class = $this->available_algorithms[$algorithm];
    return new $hasher_class($iterations);
  }

}
