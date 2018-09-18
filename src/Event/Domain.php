<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Event;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Domain extends StringValueObject
{
    const SEPARATOR = ':';

    public function __construct(string $value)
    {
        Assertion::notEmpty($value);
        parent::__construct(self::class, $value);
    }

    /**
     * @param string ...$values
     * @return Domain
     * @throws \Assert\AssertionFailedException
     */
    public static function fromParts(string... $values): Domain
    {
        foreach ($values as $value) {
            Assertion::notEmpty($value);
            Assertion::regex($value, sprintf('/^[^%s]*$/', self::SEPARATOR));
        }
        return new self(join(self::SEPARATOR, $values));
    }
}
