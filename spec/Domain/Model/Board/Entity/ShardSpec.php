<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\Entity;

use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;

class ShardSpec extends ObjectBehavior
{
    function let(Source $source)
    {
        $this->beConstructedWith($source);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Shard::class);
    }

    function it_should_have_acceptable_source()
    {
        $this->getAcceptableSource()->shouldBeAnInstanceOf(Source::class);
    }
}
