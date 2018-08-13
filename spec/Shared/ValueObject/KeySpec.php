<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Shared\ValueObject;

use Aggrego\Domain\Shared\ValueObject\Key;
use PhpSpec\ObjectBehavior;

class KeySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['init']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Key::class);
    }

    function it_should_get_array_value()
    {
        $this->getValue()->shouldBeArray();
    }
}
