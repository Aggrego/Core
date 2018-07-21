<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;

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
}
