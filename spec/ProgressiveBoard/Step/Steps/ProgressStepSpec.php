<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Step\Steps;

use Aggrego\Domain\ProgressiveBoard\Shard\Collection;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\ProgressStep;
use PhpSpec\ObjectBehavior;

class ProgressStepSpec extends ObjectBehavior
{
    function let(Collection $collection)
    {
        $this->beConstructedWith(State::createInitial(), $collection);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProgressStep::class);
        $this->shouldHaveType(Step::class);
    }
}
