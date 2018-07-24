<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Exception\UnprocessableBoardException;

class UnprocessableBoardExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnprocessableBoardException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
