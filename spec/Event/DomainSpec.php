<?php

namespace spec\Aggrego\EventConsumer\Event;

use Aggrego\EventConsumer\Event\Domain;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class DomainSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Domain::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_should_throw_exception_with_invalid_format()
    {
        $this->beConstructedWith('');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_could_be_constructed_from_parts()
    {
        $this->beConstructedThrough('fromParts', ['test1', 'test2', 'test3']);
        $this->getValue()->shouldReturn('test1:test2:test3');
    }

    function it_should_throw_exception_constructed_from_wrong_parts()
    {
        $this->beConstructedThrough('fromParts', ['test:1', 'test2', 'test3']);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

}
