<?php

namespace spec\TimiTao\Construo\Domain\Factory;

use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;
use TimiTao\Construo\Domain\Factory\BoardFactory;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;

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
