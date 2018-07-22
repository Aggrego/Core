<?php

namespace spec\TimiTao\Construo\Domain\ValueObject;

use Assert\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use stdClass;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use TimiTao\Construo\Domain\ValueObject\Shards;
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
}
