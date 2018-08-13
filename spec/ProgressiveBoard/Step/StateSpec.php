<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\ProgressiveBoard\Step;

use Aggrego\Domain\ProgressiveBoard\Step\State;
use PhpSpec\ObjectBehavior;

class StateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(State::class);
    }

    function it_should_check_final_state()
    {
        $this->isFinal()->shouldBeBool();
    }

    function it_should_check_equal_states()
    {
        $this->equal(State::createInitial())->shouldBeBool();
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }
}
