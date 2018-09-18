<?php

namespace spec\Aggrego\EventConsumer\Event;

use Aggrego\EventConsumer\Event\Version;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class VersionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('1');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Version::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_should_throw_exception_with_invalid_format()
    {
        $this->beConstructedWith('1-dev');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
