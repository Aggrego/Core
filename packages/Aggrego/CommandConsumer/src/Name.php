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

namespace Aggrego\CommandConsumer;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Name extends StringValueObject
{
    public function __construct(string $value)
    {
        Assertion::notEmpty($value);
        parent::__construct(self::class, $value);
    }
}
