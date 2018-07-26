<?php

namespace spec\Aggrego\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Exception\KeySpecificationNotFoundException;

class KeySpecificationNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(KeySpecificationNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
