<?php

namespace spec\Aggrego\Domain\Model\InitialBoard\ValueObject;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use stdClass;
use Aggrego\Domain\Model\InitialBoard\Entity\Shard;
use Aggrego\Domain\Model\InitialBoard\ValueObject\Shards;
use Traversable;

class ShardsSpec extends ObjectBehavior
{
    function let(Shard $shard)
    {
        $this->beConstructedWith([$shard]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Shards::class);
        $this->shouldBeAnInstanceOf(Traversable::class);
    }

    function it_should_throw_exception_with_other_object()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_be_able_to_add_shard(Shard $shard)
    {
        $this->add($shard)->shouldBeNull();
    }
}
