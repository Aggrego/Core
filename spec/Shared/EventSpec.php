<?php

namespace spec\Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;
use Aggrego\EventConsumer\Shared\Event;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            Domain::fromParts('test'),
            new Name('test'),
            new CreatedAt(new DateTimeImmutable()),
            new Version('1.0'),
            []
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }
}
