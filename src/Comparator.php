<?php
namespace Passwords;

class Comparator
{
    private $detector;

    public function __construct(HasherDetector $detector)
    {
        $this->detector = $detector;
    }

    public function compare(string $raw, Password $encoded): bool
    {
        $iterations = $encoded->iterations();
        if (!$iterations) {
            $iterations = null;
        }

        $hasher = $this->detector->detectByPassword($encoded);
        $raw_hash = $hasher->encode($raw, $encoded->salt(), $iterations);
        return $raw_hash === $encoded->hash();
    }
}
