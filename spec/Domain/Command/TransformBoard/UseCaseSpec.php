<?php

namespace spec\TimiTao\Construo\Domain\Command\TransformBoard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\BoardTransformation\Transformation;
use TimiTao\Construo\Domain\Command\TransformBoard\Command;
use TimiTao\Construo\Domain\Command\TransformBoard\UseCase;
use TimiTao\Construo\Domain\Factory\ProfileBoardTransformationFactory;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board as ProgressBoard;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Repository as ProgressBoardRepository;
use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Unit\Repository as UnitRepository;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

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

        $shards = Argument::type(Shards::class);
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
