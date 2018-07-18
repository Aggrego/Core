<?php

namespace spec\TimiTao\Construo\Domain\Model\Unit\ValueObject;

use Assert\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Unit\ValueObject\Key;

class KeySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['init']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Key::class);
    }

    function it_should_get_array_value()
    {
        $this->getValue()->shouldBeArray();
    }

    function it_should_throw_exception_when_initialized_by_empty_array()
    {
        $this->beConstructedWith([]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
