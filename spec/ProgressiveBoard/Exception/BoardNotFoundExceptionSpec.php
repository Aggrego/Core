<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Exception;

use Aggrego\Domain\Board\Exception\BoardNotFoundException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class BoardNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
