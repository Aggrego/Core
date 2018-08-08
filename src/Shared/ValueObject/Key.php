<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\ValueObject;

class Key
{
    /** @var array */
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
