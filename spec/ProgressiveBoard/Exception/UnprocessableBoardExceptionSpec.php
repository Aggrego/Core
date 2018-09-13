<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Exception;

use Aggrego\Domain\Board\Exception\UnprocessableBoardException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnprocessableBoardExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnprocessableBoardException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
