<?php

namespace spec\Aggrego\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Exception\BoardTransformationNotFoundException;

class BoardTransformationNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardTransformationNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
