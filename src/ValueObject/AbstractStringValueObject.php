<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ValueObject;

abstract class AbstractStringValueObject
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

    public function equal(self $name): bool
    {
        return $this->value === $name->value;
    }
}
