<?php

namespace spec\Aggrego\EventConsumer\Exception;

use Aggrego\EventConsumer\Exception\UnprocessableEventException;
use PhpSpec\ObjectBehavior;
use RuntimeException;

class UnprocessableEventExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnprocessableEventException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
