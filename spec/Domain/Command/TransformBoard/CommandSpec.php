<?php

namespace spec\TimiTao\Construo\Domain\Command\TransformBoard;

use TimiTao\Construo\Domain\Command\TransformBoard\Command;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_should_have_board_uuid()
    {
        $this->getBoardUuid()->shouldBeString();
    }
}
