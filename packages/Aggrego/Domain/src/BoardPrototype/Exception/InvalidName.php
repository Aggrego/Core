<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Domain\BoardPrototype\Exception;

use Aggrego\Domain\Exception\InvalidArgument;

class InvalidName extends InvalidArgument
{
    public static function shouldNotBeEmpty(): self
    {
        return new self('Prototype name should not be empty string');
    }
}
