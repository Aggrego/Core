<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\ValueObject;

class Uuid extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value, self::class);
    }
}
