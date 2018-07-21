<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Status;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;
use TimiTao\Construo\Domain\Query\GetUnit\Response;

class ResponseSpec extends ObjectBehavior
{
    function let(Board $board)
    {
        $board->getProfile()->willReturn(new Profile(new Name('test'), new Version('1.0.0')));
        $board->getStatus()->willReturn(new Status(Status::INITIAL));
        $this->beConstructedThrough('createValidResponse', [$board]);
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

    function it_should_have_body()
    {
        $this->getBody()->shouldBeString();
    }
}
