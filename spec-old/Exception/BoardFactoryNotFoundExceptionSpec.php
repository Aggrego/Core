<?php

namespace spec\Aggrego\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Exception\BoardFactoryNotFoundException;

class BoardFactoryNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardFactoryNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
