<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\FinalShard;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class FinalShardSpec extends ObjectBehavior
{
    function let(Uuid $uuid, Source $source, Data $data)
    {
        $source->__toString()->willReturn('test:1.0');
        $this->beConstructedWith($uuid, $source, $data);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FinalShard::class);
    }

    function it_should_have_acceptable_source()
    {
        $this->getAcceptableSource()->shouldBeAnInstanceOf(Source::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_data()
    {
        $this->getData()->shouldBeAnInstanceOf(Data::class);
    }
}
