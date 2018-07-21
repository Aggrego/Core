<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;

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
}
