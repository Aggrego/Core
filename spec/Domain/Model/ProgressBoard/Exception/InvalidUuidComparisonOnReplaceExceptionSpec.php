<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Model\ProgressBoard\Exception\InvalidUuidComparisonOnReplaceException;

class InvalidUuidComparisonOnReplaceExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidUuidComparisonOnReplaceException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
