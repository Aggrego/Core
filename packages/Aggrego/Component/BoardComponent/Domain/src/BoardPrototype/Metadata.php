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

use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

final class Metadata extends ArrayValueObject
{
    /** @param array<mixed> $value */
    protected function guard(array $value): void
    {
    }
}
