<?php

namespace spec\TimiTao\Construo\Domain\Query\GetUnit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\Factory\BoardFactory;
use TimiTao\Construo\Domain\Factory\KeySpecificationFactory;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use TimiTao\Construo\Domain\KeySpecification\Specification;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use TimiTao\Construo\Domain\Model\Board\Repository as BoardRepository;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;
use TimiTao\Construo\Domain\Query\GetUnit\Query;
use TimiTao\Construo\Domain\Query\GetUnit\Response;
use TimiTao\Construo\Domain\Query\GetUnit\UseCase;

class UseCaseSpec extends ObjectBehavior
{
    function let(
        BoardRepository $boardRepository,
        Specification $specification,
        ProfileBoardFactory $profileBoardFactory,
        BoardFactory $boardFactory
    )
    {
        /** @var Key $key */
        $key = Argument::type(Key::class);
        $specification->implement(Specification::class);
        $specification->isSatisfiedBy($key)
            ->willReturn(true);

        $keySpecificationFactory = new KeySpecificationFactory(
            ['test:1.0' => $specification->getWrappedObject()]
        );
        /** @var Key $key */
        $key = Argument::type(Key::class);
        /** @var Profile $profile */
        $profile = Argument::type(Profile::class);
        $boardFactory->implement(BoardFactory::class);
        $boardFactory->factory($key, $profile)->will(
            function(array $data) {
               return new Board(
                   $data[0],
                   $data[1],
                   new Shards(
                       [
                           new Shard(
                               new Source(
                                   new Name('test'),
                                   new Version('1.1')
                               )
                           )
                       ]
                   )
               );
            }
        );
        $profileBoardFactory->factory($profile)->willReturn($boardFactory->getWrappedObject());
        $this->beConstructedWith($boardRepository, $keySpecificationFactory, $profileBoardFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle(Query $query)
    {
        $query->getKey()->willReturn(['key' => 'test']);
        $query->getProfileName()->willReturn('test');
        $query->getVersionNumber()->willReturn('1.0');
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }

    function it_should_handle_unknown_profile(Query $query)
    {
        $query->getKey()->willReturn(['key' => 'test']);
        $query->getProfileName()->willReturn('unknown');
        $query->getVersionNumber()->willReturn('1.0');
        $this->handle($query)->shouldBeAnInstanceOf(Response::class);
    }
}
