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
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }
}
