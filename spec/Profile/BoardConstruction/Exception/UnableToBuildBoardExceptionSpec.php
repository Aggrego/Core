<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Profile\BoardConstruction\Exception;

use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnableToBuildBoardExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnableToBuildBoardException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
