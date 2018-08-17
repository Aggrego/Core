<?php

namespace spec\Aggrego\Domain\Profile\ValueObject;

use Aggrego\Domain\Profile\ValueObject\Version;
use Assert\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class VersionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('init');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Version::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function is_should_check_equal_instances(Version $version)
    {
        $this->equal($version)->shouldBeBool();
    }

    function it_should_throw_exception_when_contain_colon()
    {
        $this->beConstructedWith('test:test');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
