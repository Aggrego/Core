<?php

namespace spec\Aggrego\Domain\Profile\ValueObject;

use Aggrego\Domain\Profile\ValueObject\Name;
use Assert\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Name::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function is_should_check_equal_instances(Name $name)
    {
        $this->equal($name)->shouldBeBool();
    }

    function it_should_throw_exception_when_contain_colon()
    {
        $this->beConstructedWith('test:test');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
