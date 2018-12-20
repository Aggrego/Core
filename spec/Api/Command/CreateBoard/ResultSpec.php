<?php

namespace spec\Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Api\Command\CreateBoard\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Result::class);
    }
}
