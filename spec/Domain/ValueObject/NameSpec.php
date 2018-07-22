<?php

namespace spec\TimiTao\Construo\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\ValueObject\Name;

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
}
