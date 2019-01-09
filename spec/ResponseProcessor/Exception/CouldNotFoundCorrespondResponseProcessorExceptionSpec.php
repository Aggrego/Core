<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace spec\Aggrego\CommandLogicUnit\ResponseProcessor\Exception;

use Aggrego\CommandLogicUnit\ResponseProcessor\Exception\CouldNotFoundCorrespondResponseProcessorException;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class CouldNotFoundCorrespondResponseProcessorExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CouldNotFoundCorrespondResponseProcessorException::class);
        $this->shouldHaveType(InvalidArgumentException::class);
    }
}
