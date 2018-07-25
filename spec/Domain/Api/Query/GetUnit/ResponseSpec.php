<?php

namespace spec\TimiTao\Construo\Domain\Api\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Api\Query\GetUnit\Response;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

class ResponseSpec extends ObjectBehavior
{
    function let(Unit $unit)
    {
        $unit->getKey()->willReturn(new Key([]));
        $unit->getProfile()->willReturn(new Profile(new Name('test'), new Version('1.0.0')));
        $unit->getData()->willReturn(new Data('test'));
        $this->beConstructedThrough('createValidResponse', [$unit]);
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
