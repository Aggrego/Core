<?php

namespace spec\Aggrego\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Exception\UnprocessableBoardException;

class UnprocessableBoardExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnprocessableBoardException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
