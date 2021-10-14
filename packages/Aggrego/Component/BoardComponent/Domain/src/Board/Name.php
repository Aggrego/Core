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
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

final class Name extends StringValueObject
{
}
