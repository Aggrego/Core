<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Exception\BoardTransformationNotFoundException;

class BoardTransformationNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardTransformationNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
