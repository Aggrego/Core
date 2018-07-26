<?php

namespace spec\Aggrego\Domain\Model\InitialBoard\Entity;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Model\InitialBoard\Entity\Shard;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

class ShardSpec extends ObjectBehavior
{
    function let(Uuid $uuid, Key $key, Source $source)
    {
        $key->getValue()->willReturn(['init']);
        $source->__toString()->willReturn('test:1.0');
        $this->beConstructedWith($uuid, $source, $key);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Shard::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_acceptable_source()
    {
        $this->getAcceptableSource()->shouldBeAnInstanceOf(Source::class);
    }
}
