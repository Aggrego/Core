<?php

namespace spec\TimiTao\Construo\Domain\Factory;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;
use TimiTao\Construo\Domain\Factory\BoardFactory;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

class ProfileBoardFactorySpec extends ObjectBehavior
{
    function let(BoardFactory $boardFactory)
    {
        $this->beConstructedWith(
            ['test:1.0' => $boardFactory]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileBoardFactory::class);
    }

    function it_should_factory_board_factory()
    {
        $profile = new Profile(new Name('test'), new Version('1.0'));
        $this->factory($profile)->shouldBeAnInstanceOf(BoardFactory::class);
    }

    function it_should_throw_exception_on_unknown_profile()
    {
        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(BoardFactoryNotFoundException::class)->during('factory', [$profile]);
    }
}
