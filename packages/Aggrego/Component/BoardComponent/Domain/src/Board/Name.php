<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Board;

use Assert\Assertion;
use Assert\AssertionFailedException;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

final class Name extends StringValueObject
{
    /**
     * @throws AssertionFailedException
     */
    protected function guard(string $value): void
    {
        Assertion::notEmpty($value);
    }
}
