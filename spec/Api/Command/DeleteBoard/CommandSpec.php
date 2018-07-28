<?php

namespace spec\Aggrego\Domain\Api\Command\DeleteBoard;

use Aggrego\Domain\Api\Command\DeleteBoard\Command;
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
