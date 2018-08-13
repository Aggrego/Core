<?php

namespace spec\Aggrego\Domain\Model\InitialBoard\Entity;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Model\InitialBoard\Entity\Board;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Traversable;

class BoardSpec extends ObjectBehavior
{
    function let(Key $key, Profile $profile)
    {
        $key->getValue()->willReturn(['init']);
        $profile->__toString()->willReturn('test:1.0');
        $this->beConstructedWith($key, $profile);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldBeAnInstanceOf(Profile::class);
    }

    function it_should_have_shards_as_list()
    {
        $this->getShards()->shouldBeAnInstanceOf(Traversable::class);
    }

    function it_should_be_able_to_add_shards(Key $key, Source $source)
    {
        $key->getValue()->willReturn(['init']);
        $source->__toString()->willReturn('test:1.0');
        $this->addShard($key, $source)->shouldBeNull();
    }
}
