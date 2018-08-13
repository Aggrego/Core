<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Exception;

use Aggrego\Domain\ProgressiveBoard\Exception\InvalidUuidComparisonOnReplaceException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class InvalidUuidComparisonOnReplaceExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidUuidComparisonOnReplaceException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
