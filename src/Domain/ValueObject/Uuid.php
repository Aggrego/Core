<?php

namespace TimiTao\Construo\Domain\ValueObject;

class Uuid
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equal(Uuid $uuid): bool
    {
        return $this->value === $uuid->value;
    }
}
