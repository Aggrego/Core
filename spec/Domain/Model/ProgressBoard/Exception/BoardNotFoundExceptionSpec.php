<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Model\ProgressBoard\Exception\BoardNotFoundException;

class BoardNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
