<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Profile;

final class KeyChange
{
    /** @param array<mixed> $value */
    public function __construct(
        private array $value
    ) {
    }

    /** @return array<mixed> */
    public function getValue(): array
    {
        return $this->value;
    }
}
