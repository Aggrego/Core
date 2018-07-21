<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use Throwable;
use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardFactoryNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardFactoryNotFoundException::class);
        $this->shouldBeAnInstanceOf(Throwable::class);
    }
}
