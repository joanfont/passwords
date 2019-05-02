<?php
namespace Passwords;


class Comparator
{
  private $detector;

  public function __construct(HasherFactory $detector)
  {
    $this->detector = $detector;
  }

  public function compare(string $raw, Password $encoded): bool
  {
    $iterations = $encoded->iterations();
    if (!$iterations) {
      $iterations = null;
    }

    $hasher = $this->detector->makeFromPassword($encoded);
    $raw_hash = $hasher->encode($raw, $encoded->salt());
    return $raw_hash === $encoded->hash();
  }
}
