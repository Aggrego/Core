<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Aggrego\Domain\Model\ProgressBoard\Exception\InvalidUuidComparisonOnReplaceException;

class InvalidUuidComparisonOnReplaceExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidUuidComparisonOnReplaceException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
