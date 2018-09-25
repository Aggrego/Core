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

namespace spec\Aggrego\Domain\Api\Command\TransformBoard\Exception;

use Aggrego\Domain\Api\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Shared\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class InvalidCommandDataExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidCommandDataException::class);
        $this->shouldBeAnInstanceOf(InvalidArgumentException::class);
    }
}
