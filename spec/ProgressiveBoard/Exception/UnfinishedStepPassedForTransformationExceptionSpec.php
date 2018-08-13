<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Exception;

use Aggrego\Domain\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnfinishedStepPassedForTransformationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnfinishedStepPassedForTransformationException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
