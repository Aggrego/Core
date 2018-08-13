<?php

namespace spec\Aggrego\Domain\Model\Unit\Exception;

use Aggrego\Domain\Model\Unit\Exception\UnitExistException;
use PhpSpec\ObjectBehavior;
use RuntimeException;

class UnitExistExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnitExistException::class);
        $this->shouldImplement(RuntimeException::class);
    }
}
