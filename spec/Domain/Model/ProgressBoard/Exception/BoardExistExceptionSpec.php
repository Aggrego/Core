<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Exception;

use RuntimeException;
use TimiTao\Construo\Domain\Model\ProgressBoard\Exception\BoardExistException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardExistExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardExistException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
