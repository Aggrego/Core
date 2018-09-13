<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Step\Steps;

use Aggrego\Domain\Board\Step\State;
use Aggrego\Domain\Board\Step\Step;
use Aggrego\Domain\Board\Step\Steps\FinalStep;
use Aggrego\Domain\Shared\ValueObject\Data;
use PhpSpec\ObjectBehavior;

class FinalStepSpec extends ObjectBehavior
{

    function let(Data $data)
    {
        $this->beConstructedWith($data);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FinalStep::class);
        $this->shouldHaveType(Step::class);
    }

    function it_should_have_state()
    {
        $subject = $this->getState();
        $subject->shouldBeAnInstanceOf(State::class);
        $subject->getValue()->shouldBe(State::FINAL);
    }

    function it_should_have_data()
    {
        $this->getData()->shouldBeAnInstanceOf(Data::class);
    }
}
