<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;

class KeySpecificationNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(KeySpecificationNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
