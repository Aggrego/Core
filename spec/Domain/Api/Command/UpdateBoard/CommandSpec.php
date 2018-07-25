<?php

namespace spec\TimiTao\Construo\Domain\Api\Command\UpdateBoard;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Api\Command\UpdateBoard\Command;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            '123e4567-e89b-12d3-a456-426655440000',
            '123e4567-e89b-12d3-a456-426655440001',
            'test',
            '1.0',
            'test_data'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_should_have_board_uuid()
    {
        $this->getBoardUuid()->shouldBeString();
    }

    function it_should_have_shard_uuid()
    {
        $this->getShardUuid()->shouldBeString();
    }

    function it_should_have_array_value_as_key()
    {
        $this->getBoardUuid()->shouldBeString();
    }

    function it_should_have_source_name()
    {
        $this->getSourceName()->shouldBeString();
    }

    function it_should_have_version_name()
    {
        $this->getVersionName()->shouldBeString();
    }

    function it_should_have_data()
    {
        $this->getData()->shouldBeString();
    }
}
