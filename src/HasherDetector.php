<?php

namespace Passwords;

use Passwords\Hasher\Hasher;

class HasherDetector
{
  private $available_algorithms;

  public function __construct(array $available_algorithms)
  {
    $this->available_algorithms = [];
    foreach ($available_algorithms as $available_algorithm) {
      $this->available_algorithms[$available_algorithm::NAME] = $available_algorithm;
    }
  }

  public function detectByPassword(Password $hash): Hasher
  {
    $algorithm = $hash->algorithm();
    return $this->getHasherInstance($algorithm);
  }

  public function detectByAlgorithm(string $algorithm): Hasher
  {
    return $this->getHasherInstance($algorithm);
  }

  public function detectByHasher(string $hasher): Hasher
  {
    $hasher_instance = new $hasher;
    return $this->getHasherInstance($hasher_instance::NAME);
  }

  private function getHasherInstance(?string $algorithm): Hasher
  {
    if (!array_key_exists($algorithm, $this->available_algorithms)) {
      throw new Exception\UnknownAlgorithm("Algorithm {$algorithm} not in known algorithms list");
    }

    return new $this->available_algorithms[$algorithm];
  }

}
