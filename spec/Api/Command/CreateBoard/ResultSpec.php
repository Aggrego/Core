<?php

namespace spec\Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Api\Command\CreateBoard\Result;
use PhpSpec\ObjectBehavior;

class ResultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Result::class);
        $this->shouldHaveType(Response::class);
    }
}
