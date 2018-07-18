<?php

namespace spec\TimiTao\Construo\Domain\Model\Unit\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\ValueObject\Key;

class UnitSpec extends ObjectBehavior
{
    function let(Key $key)
    {
        $this->beConstructedWith($key);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Unit::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }
}
