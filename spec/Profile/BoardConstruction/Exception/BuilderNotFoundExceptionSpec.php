<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Profile\BoardConstruction\Exception;

use Aggrego\Domain\Profile\BoardConstruction\Exception\BuilderNotFoundException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class BuilderNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BuilderNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
