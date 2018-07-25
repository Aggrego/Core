<?php

namespace spec\TimiTao\Construo\Domain\Api\Command\CreateBoard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\Api\Command\CreateBoard\Command;
use TimiTao\Construo\Domain\Api\Command\CreateBoard\UseCase;
use TimiTao\Construo\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use TimiTao\Construo\Domain\Factory\ProfileKeySpecificationFactory;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Repository;
use TimiTao\Construo\Domain\Profile\BoardFactory\Factory;
use TimiTao\Construo\Domain\Profile\KeySpecification\Specification;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;

class UseCaseSpec extends ObjectBehavior
{
    function let(
        Repository $boardRepository,
        Specification $specification,
        ProfileBoardFactory $profileBoardFactory,
        Factory $boardFactory
    )
    {
        /** @var Key $key */
        $key = Argument::type(Key::class);
        /** @var Profile $profile */
        $profile = Argument::type(Profile::class);

        $specification->isSatisfiedBy($key)->willReturn(true);
        $specification->isSupported($profile)->willReturn(true);

        $keySpecificationFactory = new ProfileKeySpecificationFactory([$specification->getWrappedObject()]);
        /** @var Key $key */
        $key = Argument::type(Key::class);
        $boardFactory->factory($key, $profile)->will(
            function (array $data) {
                $key = $data[0];
                /** @var Profile $profile */
                $profile = $data[1];
                $board = new InitialBoard($key, $profile);
                $board->addShard($key, new Source($profile->getName(), $profile->getVersion()));
                return $board;
            }
        );
        $profileBoardFactory->factory($profile)->willReturn($boardFactory->getWrappedObject());
        $this->beConstructedWith($boardRepository, $keySpecificationFactory, $profileBoardFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle(Command $command)
    {
        $command->getKey()->willReturn(['key' => 'test']);
        $command->getProfileName()->willReturn('test');
        $command->getVersionNumber()->willReturn('1.0');
        $this->handle($command)->shouldBeNull();
    }

    function it_should_reject_wrong_keys(
        Command $command,
        Repository $boardRepository,
        Specification $specification,
        ProfileBoardFactory $profileBoardFactory,
        Factory $boardFactory)
    {
        /** @var Key $key */
        $key = Argument::type(Key::class);
        /** @var Profile $profile */
        $profile = Argument::type(Profile::class);

        $specification->isSatisfiedBy($key)->willReturn(false);
        $specification->isSupported($profile)->willReturn(true);

        $keySpecificationFactory = new ProfileKeySpecificationFactory([$specification->getWrappedObject()]);

        $boardFactory->factory($key, $profile)->will(
            function (array $data) {
                $key = $data[0];
                /** @var Profile $profile */
                $profile = $data[1];
                $board = new InitialBoard($key, $profile);
                $board->addShard($key, new Source($profile->getName(), $profile->getVersion()));
                return $board;
            }
        );
        $profileBoardFactory->factory($profile)->willReturn($boardFactory->getWrappedObject());
        $this->beConstructedWith($boardRepository, $keySpecificationFactory, $profileBoardFactory);

        $command->getKey()->willReturn(['wrong' => 'key']);
        $command->getProfileName()->willReturn('test');
        $command->getVersionNumber()->willReturn('1.0');
        $this->shouldThrow(ProfileKeySpecificationNotSatisfiedException::class)->during('handle', [$command]);
    }
}
