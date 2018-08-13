<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Model\ProgressBoard\Exception\BoardExistException;

class BoardExistExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardExistException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
