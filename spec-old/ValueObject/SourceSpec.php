<?php

namespace spec\Aggrego\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Version;

class SourceSpec extends ObjectBehavior
{
    function let(Name $name, Version $version)
    {
        $this->beConstructedWith($name, $version);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Source::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_should_have_version()
    {
        $this->getVersion()->shouldBeAnInstanceOf(Version::class);
    }

    function is_should_check_equal_instances(Source $source)
    {
        $this->equal($source)->shouldBeBool();
    }

    function it_should_convert_to_string()
    {
        $this->beConstructedWith(new Name('test'), new Version('1.0.0'));
        $subject = $this->__toString();
        $subject->shouldBeString();
        $subject->shouldBe('test:1.0.0');
    }
}
