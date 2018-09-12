<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\ValueObject;

use TimiTao\ValueObject\Utils\StringValueObject;

class Uuid extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct(self::class, $value);
    }
}
