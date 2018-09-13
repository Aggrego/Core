<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Step\Steps;

use Aggrego\Domain\Board\Shard\Collection;
use Aggrego\Domain\Board\Step\State;
use Aggrego\Domain\Board\Step\Step;
use Aggrego\Domain\Board\Step\Steps\ProgressStep;
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
