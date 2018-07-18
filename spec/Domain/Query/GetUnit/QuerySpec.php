<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Query\GetUnit\Query;

class QuerySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Query::class);
    }

    function it_should_have_array_value_as_key()
    {
        $this->getKey()->shouldBeArray();
    }
}
