<?php

namespace Passwords;


use Passwords\Hasher\Hasher;

class Helper
{
  private static $instance = null;

  private $factory = null;

  private $comparator = null;

  private static $default_hasher = null;

  private static $available_hashers = [];

  public function __construct(HasherFactory $factory, Comparator $comparator)
  {
    $this->factory = $factory;
    $this->comparator = $comparator;
  }

  public static function check(string $raw, string $encoded): bool
  {
    $password = Password::fromRawValue($encoded);
    return static::getInstance()->getDefaultComparator()->compare($raw, $password);
  }

  public static function make(string $raw, ?string $salt): string
  {
    $hasher = static::getDefaultHasher();
    $hash = $hasher->encode($raw, $salt);

    $password = new Password(
      $hasher->algorithm(),
      $hasher->iterations(),
      $salt,
      $hash
    );

    return (string) $password;
  }

  public static function setInstance(Helper $helper)
  {
    static::$instance = $helper;
  }

  public static function setDefaultHasher(Hasher $hasher)
  {
    static::$default_hasher = $hasher;
  }

  public static function registerHasher(Hasher $hasher)
  {
    static::$available_hashers[$hasher::NAME] = $hasher;
  }

  private static function getInstance(): Helper
  {
    if (static::$instance === null) {
      $default_factory = static::getDefaultFactory();
      $default_comparator = static::getDefaultComparator();
      static::$instance = new self($default_factory, $default_comparator);
    }

    return static::$instance;
  }

  private static function getDefaultComparator(): Comparator
  {
    return new Comparator(static::getDefaultFactory());
  }

  private static function getDefaultFactory(): HasherFactory
  {
    $available_hashers = [];
    foreach (static::$available_hashers as $available_hasher) {
      $available_hashers[$available_hasher::NAME] = get_class($available_hasher);
    }

    return new HasherFactory($available_hashers);
  }

  private static function getDefaultHasher()
  {
    $default_hasher = static::$default_hasher;
    if ($default_hasher === null) {
      reset(static::$available_hashers);
      $default_hasher = current(static::$available_hashers);
    }

    return $default_hasher;
  }
}
