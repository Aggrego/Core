<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Query\GetUnit\Query;
use TimiTao\Construo\Domain\Query\GetUnit\Response;
use TimiTao\Construo\Domain\Query\GetUnit\UseCase;

class UseCaseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle(Query $query)
    {
        $query->getProfileName()->willReturn('test');
        $query->getVersionNumber()->willReturn('1.0.0');
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }
}
