<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\InitialShard;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class InitialShardSpec extends ObjectBehavior
{
    function let(Uuid $uuid, Key $key, Source $source)
    {
        $key->getValue()->willReturn(['init']);
        $source->__toString()->willReturn('test:1.0');
        $this->beConstructedWith($uuid, $source, $key);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(InitialShard::class);
    }

    function it_should_have_acceptable_source()
    {
        $this->getAcceptableSource()->shouldBeAnInstanceOf(Source::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }
}
