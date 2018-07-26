<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Events;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Event\Event;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\InitialShard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Events\ShardAddedEvent;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

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
