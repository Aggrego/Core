<?php

namespace spec\Aggrego\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

class ProfileSpec extends ObjectBehavior
{
    function let(Name $name, Version $version)
    {
        $this->beConstructedWith($name, $version);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Profile::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_should_have_version()
    {
        $this->getVersion()->shouldBeAnInstanceOf(Version::class);
    }

    function it_should_convert_to_string()
    {
        $this->beConstructedWith(new Name('test'), new Version('1.0.0'));
        $subject = $this->__toString();
        $subject->shouldBeString();
        $subject->shouldBe('test:1.0.0');
    }

}
