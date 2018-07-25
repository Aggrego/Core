<?php

namespace spec\TimiTao\Construo\Domain\Api\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Api\Query\GetUnit\Query;
use TimiTao\Construo\Domain\Api\Query\GetUnit\Response;
use TimiTao\Construo\Domain\Api\Query\GetUnit\UseCase;
use TimiTao\Construo\Domain\Model\Unit\Repository;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle(Query $query)
    {
        $query->getKey()->willReturn(['key' => 'test']);
        $query->getProfileName()->willReturn('test');
        $query->getVersionNumber()->willReturn('1.0');
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }

    function it_should_handle_unknown_profile(Query $query)
    {
        $query->getKey()->willReturn(['key' => 'test']);
        $query->getProfileName()->willReturn('unknown');
        $query->getVersionNumber()->willReturn('1.0');
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }
}
