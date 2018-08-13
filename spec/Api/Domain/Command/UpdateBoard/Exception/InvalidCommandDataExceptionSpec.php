<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Api\Domain\Command\UpdateBoard\Exception;

use Aggrego\Domain\Api\Domain\Command\UpdateBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Shared\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class InvalidCommandDataExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidCommandDataException::class);
        $this->shouldBeAnInstanceOf(InvalidArgumentException::class);
    }
}
