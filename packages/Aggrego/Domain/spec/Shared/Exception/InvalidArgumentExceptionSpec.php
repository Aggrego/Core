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

namespace spec\Aggrego\Domain\Shared\Exception;

use Aggrego\Domain\Shared\Exception\InvalidArgumentException;
use InvalidArgumentException as GeneralInvalidArgumentException;
use PhpSpec\ObjectBehavior;

class InvalidArgumentExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidArgumentException::class);
        $this->shouldHaveType(GeneralInvalidArgumentException::class);
    }
}
