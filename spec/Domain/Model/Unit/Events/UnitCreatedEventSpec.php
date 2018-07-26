<?php

namespace spec\TimiTao\Construo\Domain\Model\Unit\Events;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Event\Event;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\Events\UnitCreatedEvent;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

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
