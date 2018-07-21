<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;

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
}
