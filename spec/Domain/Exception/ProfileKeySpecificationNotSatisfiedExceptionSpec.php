<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;

class ProfileKeySpecificationNotSatisfiedExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileKeySpecificationNotSatisfiedException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
