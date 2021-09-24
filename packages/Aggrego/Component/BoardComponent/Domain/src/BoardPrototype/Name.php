<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\BoardPrototype;

use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Exception\InvalidName;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

final class Name extends StringValueObject
{
    /**
     * @throws InvalidName if value is invalid
     */
    protected function guard(string $value): void
    {
        $trimmed = trim($value);

        if (strlen($trimmed) === 0) {
            throw InvalidName::shouldNotBeEmpty();
        }
    }
}
