<?php

namespace spec\Aggrego\Domain\Api\Command\DeleteBoard;

use Aggrego\Domain\Api\Command\DeleteBoard\Command;
use Aggrego\Domain\Api\Command\DeleteBoard\UseCase;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\ProgressBoard\Repository;
use Aggrego\Domain\ValueObject\Uuid;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository, Board $board)
    {
        $uuid = Argument::type(Uuid::class);
        $repository->getBoardByUuid($uuid)->willReturn($board);
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle_command()
    {
        $command = new Command('test');
        $this->handle($command)->shouldBeNull();
    }
}
