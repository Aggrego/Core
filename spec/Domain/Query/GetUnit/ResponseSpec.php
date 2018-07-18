<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use TimiTao\Construo\Domain\Query\GetUnit\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }
}
