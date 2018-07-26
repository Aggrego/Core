<?php

namespace spec\Aggrego\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;

class ProfileKeySpecificationNotSatisfiedExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileKeySpecificationNotSatisfiedException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
