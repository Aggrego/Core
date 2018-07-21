<?php

namespace TimiTao\Construo\Domain\Model\Board\ValueObject;

use Assert\Assertion;

class Status
{
    public const INITIAL = 'initial';
    public const INVALID = 'invalid';

    private const AVAILABLE_VALUES = [
        self::INITIAL,
        self::INVALID
    ];

    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        Assertion::inArray($value, self::AVAILABLE_VALUES);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
