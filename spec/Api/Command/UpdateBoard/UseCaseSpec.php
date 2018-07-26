<?php

namespace spec\Aggrego\Domain\Api\Command\UpdateBoard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Aggrego\Domain\Api\Command\UpdateBoard\Command;
use Aggrego\Domain\Api\Command\UpdateBoard\UseCase;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\ProgressBoard\Repository;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle_command(Repository $repository, Board $board)
    {
        $board->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440000'));
        $uuid = Argument::type(Uuid::class);
        $source = Argument::type(Source::class);
        $data = Argument::type(Data::class);
        $board->updateShard($uuid, $source, $data)->shouldBeCalled();

        $repository->getBoardByUuid($uuid)->willReturn($board);

        $command = new Command(
            '123e4567-e89b-12d3-a456-426655440000',
            '123e4567-e89b-12d3-a456-426655440001',
            'test',
            '1.0',
            'test_data'
        );
        $this->handle($command)->shouldBeNull();
    }
}
