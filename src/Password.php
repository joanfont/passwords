<?php
namespace Passwords;

class Password
{
    const DELIMITER = '$';

    private $algorithm;

    private $iterations;

    private $salt;

    private $hash;

    public function __construct(string $algorithm, ?int $iterations, ?string $salt, string $hash)
    {
        $this->algorithm = $algorithm;
        $this->iterations = $iterations;
        $this->salt = $salt;
        $this->hash = $hash;
    }

    public function __toString()
    {
        return sprintf(
            "%s%s%s%s%s%s%s",
            $this->algorithm,
            static::DELIMITER,
            $this->iterations,
            static::DELIMITER,
            $this->salt,
            static::DELIMITER,
            $this->hash
        );
    }

    public function algorithm(): string
    {
        return $this->algorithm;
    }

    public function iterations(): ?int
    {
        return $this->iterations;
    }

    public function salt(): ?string
    {
        return $this->salt;
    }

    public function hash(): string
    {
        return $this->hash;
    }

    public static function fromRawValue(string $raw): self
    {
        $hash_parts = explode(static::DELIMITER, $raw);

        $iterations = $hash_parts[1];
        if ($iterations === '') {
          $iterations = null;
        }

        return new self($hash_parts[0], $iterations, $hash_parts[2], $hash_parts[3]);
    }
}
