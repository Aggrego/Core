<?php

namespace TimiTao\Construo\Domain\Model\Unit\ValueObject;

use Assert\Assertion;

class Key
{
    /** @var array */
    private $value;

    public function __construct(array $value)
    {
        Assertion::min(count($value), 1);
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
