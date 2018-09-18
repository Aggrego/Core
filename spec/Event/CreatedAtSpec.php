<?php

namespace spec\Aggrego\EventConsumer\Event;

use Aggrego\EventConsumer\Event\CreatedAt;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class CreatedAtSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new DateTimeImmutable());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedAt::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }
}
