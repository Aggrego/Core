<?php

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
