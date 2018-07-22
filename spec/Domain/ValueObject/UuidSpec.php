<?php

namespace spec\TimiTao\Construo\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class UuidSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Uuid::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_should_check_equal_instance(Uuid $uuid)
    {
        $this->equal($uuid)->shouldBeBool();
    }
}
