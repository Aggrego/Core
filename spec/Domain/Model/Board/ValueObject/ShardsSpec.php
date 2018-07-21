<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use Assert\InvalidArgumentException;
use stdClass;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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

    function it_should_throw_exception_on_empty_array()
    {
        $this->beConstructedWith([]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_throw_exception_with_other_object()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
