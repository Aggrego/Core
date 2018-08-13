<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Shared\Exception;

use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;
use RuntimeException as GeneralRuntimeException;

class RuntimeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RuntimeException::class);
        $this->shouldHaveType(GeneralRuntimeException::class);
    }
}
