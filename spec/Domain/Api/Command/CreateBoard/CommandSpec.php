<?php

namespace spec\TimiTao\Construo\Domain\Api\Command\CreateBoard;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Api\Command\CreateBoard\Command;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'test', '1.0.0');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_should_have_array_value_as_key()
    {
        $this->getKey()->shouldBeArray();
    }

    function it_should_have_profile_name()
    {
        $this->getProfileName()->shouldBeString();
    }

    function it_should_have_version_number()
    {
        $this->getVersionNumber()->shouldBeString();
    }
}
