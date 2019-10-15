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

namespace Aggrego\Domain\BoardPrototype;

use Aggrego\Domain\BoardPrototype\Exception\InvalidName;
use TimiTao\ValueObject\Utils\StringValueObject;

final class Name extends StringValueObject
{
    /**
     * @throws InvalidName
     */
    public function __construct(string $value)
    {
        $trimmed = trim($value);

        if (strlen($trimmed) === 0) {
            throw InvalidName::shouldNotBeEmpty();
        }

        parent::__construct(self::class, $value);
    }
}
