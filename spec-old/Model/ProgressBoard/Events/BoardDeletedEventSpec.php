<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\Events;

use Aggrego\Domain\Event\Event;
use Aggrego\Domain\Model\ProgressBoard\Events\BoardDeletedEvent;
use PhpSpec\ObjectBehavior;

class BoardDeletedEventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardDeletedEvent::class);
        $this->shouldImplement(Event::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeString();
    }

    function it_should_have_payload()
    {
        $payload = $this->getPayload();
        $payload->shouldBeArray();
    }
}
