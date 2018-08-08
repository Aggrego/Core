<?php

namespace spec\Aggrego\Domain\Api\Command\TransformBoard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Aggrego\Domain\Api\Command\TransformBoard\Command;
use Aggrego\Domain\Api\Command\TransformBoard\UseCase;
use Aggrego\Domain\Factory\ProfileBoardTransformationFactory;
use Aggrego\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board as ProgressBoard;
use Aggrego\Domain\Model\ProgressBoard\Repository as ProgressBoardRepository;
use Aggrego\Domain\Model\ProgressBoard\ValueObject\Collection;
use Aggrego\Domain\Model\Unit\Repository as UnitRepository;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;

class UseCaseSpec extends ObjectBehavior
{
    function let(
        ProgressBoardRepository $progressBoardRepository,
        UnitRepository $unitRepository,
        ProfileBoardTransformationFactory $boardTransformationFactory,
        Transformation $transformation
    )
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $profile = new Profile($name, $version);

        $board = new InitialBoard($key, $profile);
        $board->addShard($key, new Source($name, $version));
        $progressBoard = ProgressBoard::factoryFromInitial($board);
        $progressBoard->updateShard(
            new Uuid('4b7c7c15-6b50-5a1f-94ca-20a9749c5bc2'),
            new Source($name, $version),
            new Data('test')
        );

        $uuid = Argument::type(Uuid::class);
        $progressBoardRepository->getBoardByUuid($uuid)->willReturn($progressBoard);

        $boardTransformationFactory->factory($profile)->willReturn($transformation);

        $shards = Argument::type(Collection::class);
        $transformation->process($shards)->willReturn(new Data('test-double'));
        $this->beConstructedWith($progressBoardRepository, $unitRepository, $boardTransformationFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle_command(Command $command)
    {
        $command->getBoardUuid()->willReturn('123e4567-e89b-12d3-a456-426655440000');
        $this->handle($command)->shouldBeNull();
    }
}
