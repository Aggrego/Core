<?php

namespace spec\Aggrego\Domain\Api\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Api\Query\GetUnit\Response;
use Aggrego\Domain\Model\Unit\Entity\Unit;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

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
