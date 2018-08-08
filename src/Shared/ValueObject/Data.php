<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\ValueObject;

class Data extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value, self::class);
    }
}
