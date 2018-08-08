<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\ValueObject;

abstract class AbstractStringValueObject
{
    /** @var string */
    private $value;

    /** @var string */
    private $type;

    public function __construct(string $value, string $type)
    {
        $this->value = $value;
        $this->type = $type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equal(self $object): bool
    {
        return $this->value === $object->value
            && $this->type === $object->type;
    }
}
