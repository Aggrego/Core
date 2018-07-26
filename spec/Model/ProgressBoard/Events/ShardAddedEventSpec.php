<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\Events;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Event\Event;
use Aggrego\Domain\Model\ProgressBoard\Entity\InitialShard;
use Aggrego\Domain\Model\ProgressBoard\Events\ShardAddedEvent;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;

class ShardAddedEventSpec extends ObjectBehavior
{
    function let(InitialShard $shard)
    {
        $shard->getUuid()->willReturn(new Uuid('test'));
        $shard->getKey()->willReturn(new Key(['test']));
        $shard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->beConstructedWith($shard);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ShardAddedEvent::class);
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
        $payload->shouldHaveKey('shard_uuid');
        $payload->shouldHaveKey('source');
        $payload->shouldHaveKey('key');
    }
}
