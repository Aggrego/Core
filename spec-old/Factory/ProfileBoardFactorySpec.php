<?php

namespace spec\Aggrego\Domain\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Aggrego\Domain\Exception\BoardFactoryNotFoundException;
use Aggrego\Domain\Factory\ProfileBoardFactory;
use Aggrego\Domain\Profile\BoardFactory\Factory;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

class ProfileBoardFactorySpec extends ObjectBehavior
{
    function let(Factory $boardFactory)
    {
        $profile = Argument::type(Profile::class);
        $boardFactory->isSupported($profile)->willReturn(true);
        $this->beConstructedWith([$boardFactory]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileBoardFactory::class);
    }

    function it_should_factory_board_factory()
    {
        $profile = new Profile(new Name('test'), new Version('1.0'));
        $this->factory($profile)->shouldBeAnInstanceOf(Factory::class);
    }

    function it_should_throw_exception_on_unknown_profile(Factory $boardFactory)
    {
        $profile = Argument::type(Profile::class);
        $boardFactory->isSupported($profile)->willReturn(false);
        $this->beConstructedWith([$boardFactory]);

        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(BoardFactoryNotFoundException::class)->during('factory', [$profile]);
    }
}
