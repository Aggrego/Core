<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\ValueObject;

use Aggrego\Domain\Shared\ValueObject\AbstractStringValueObject;
use Assert\Assertion;

class Name extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value, self::class);
        Assertion::regex($value, '^[^:]$');
    }
}
