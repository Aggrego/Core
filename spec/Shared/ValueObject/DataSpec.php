<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Shared\ValueObject;

use Aggrego\Domain\Shared\ValueObject\Data;
use PhpSpec\ObjectBehavior;

class DataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Data::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function is_should_check_equal_instances(Data $data)
    {
        $this->equal($data)->shouldBeBool();
    }
}
