<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\ValueObject;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Name extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct(self::class, $value);
        Assertion::regex($value, '/^[^:]*$/');
    }
}
