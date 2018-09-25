<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Event;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Domain extends StringValueObject
{
    private const SEPARATOR = ':';

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

    public function getParts(): array
    {
        return explode(self::SEPARATOR, $this->getValue());
    }
}
