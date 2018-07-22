<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;

class ProfileKeySpecificationNotSatisfiedExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileKeySpecificationNotSatisfiedException::class);
        $this->shouldBeAnInstanceOf(InvalidArgumentException::class);
    }
}
