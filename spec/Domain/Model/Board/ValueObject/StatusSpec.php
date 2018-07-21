<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use Assert\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Status;

class StatusSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Status::INITIAL);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Status::class);
    }

    function it_should_have_value()
    {
        $subject = $this->getValue();
        $subject->shouldBeString();
    }

    function it_should_throw_exception_with_invalid_value()
    {
        $this->beConstructedWith('invalid status');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
