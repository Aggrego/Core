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

namespace spec\Aggrego\Domain\Board\Exception;

use Aggrego\Domain\Board\Exception\UnsupportedPrototypeBuilderException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnsupportedPrototypeBuilderExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnsupportedPrototypeBuilderException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
