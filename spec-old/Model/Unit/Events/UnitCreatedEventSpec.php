<?php

namespace spec\Aggrego\Domain\Model\Unit\Events;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Event\Event;
use Aggrego\Domain\Model\Unit\Entity\Unit;
use Aggrego\Domain\Model\Unit\Events\UnitCreatedEvent;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;

class UnitCreatedEventSpec extends ObjectBehavior
{
    function let(Unit $unit)
    {
        $unit->getUuid()->willReturn(new Uuid('test'));
        $unit->getKey()->willReturn(new Key(['test']));
        $unit->getData()->willReturn(new Data('test'));
        $unit->getProfile()->willReturn(new Profile(new Name('test'), new Version('1.0')));
        $this->beConstructedWith($unit);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UnitCreatedEvent::class);
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
        $payload->shouldHaveKey('key');
        $payload->shouldHaveKey('profile');
        $payload->shouldHaveKey('data');
    }
}
