<?php

namespace spec\TimiTao\Construo\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\ValueObject\Version;

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
}
