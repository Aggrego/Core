<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Shared\ValueObject;

use Aggrego\Domain\Shared\ValueObject\Uuid;
use PhpSpec\ObjectBehavior;

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
