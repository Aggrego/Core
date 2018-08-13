<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Api\Domain\Command\UpdateBoard\Exception;

use Aggrego\Domain\Api\Domain\Command\UpdateBoard\Exception\UnprocessableCommandException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnprocessableCommandExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnprocessableCommandException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
