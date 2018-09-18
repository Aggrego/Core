<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Event;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Domain extends StringValueObject
{
    public function __construct(string $value)
    {
        Assertion::notEmpty($value);
        parent::__construct(self::class, $value);
    }
}
