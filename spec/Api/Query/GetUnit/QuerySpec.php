<?php

namespace spec\Aggrego\Domain\Api\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Api\Query\GetUnit\Query;

class QuerySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'test', '1.0.0');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Query::class);
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
