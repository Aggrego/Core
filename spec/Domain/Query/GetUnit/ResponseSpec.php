<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use TimiTao\Construo\Domain\Query\GetUnit\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('text', '1.0.0', 'status');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }

    function it_should_have_profile()
    {
        $this->getProfileName()->shouldBeString();
    }

    function it_should_have_version_number()
    {
        $this->getVersionNumber()->shouldBeString();
    }

    function it_should_have_status()
    {
        $this->getStatus()->shouldBeString();
    }
}
