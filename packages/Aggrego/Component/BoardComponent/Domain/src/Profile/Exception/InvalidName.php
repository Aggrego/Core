<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Profile\Exception;

use Aggrego\Component\BoardComponent\Domain\Exception\InvalidArgument;

class InvalidName extends InvalidArgument
{
    public static function name(string $name): self
    {
        return new self(sprintf('Name contains separator ":" char. Current: ' . $name));
    }

    public static function version(string $version): self
    {
        return new self(sprintf('Version contains separator ":" char. Current: ' . $version));
    }
}
