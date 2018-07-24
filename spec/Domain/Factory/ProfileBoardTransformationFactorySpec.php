<?php

namespace spec\TimiTao\Construo\Domain\Factory;

use TimiTao\Construo\Domain\BoardTransformation\Transformation;
use TimiTao\Construo\Domain\Exception\BoardTransformationNotFoundException;
use TimiTao\Construo\Domain\Factory\ProfileBoardTransformationFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

class ProfileBoardTransformationFactorySpec extends ObjectBehavior
{
    function let(Transformation $transformation)
    {
        $this->beConstructedWith(
            ['test:1.0' => $transformation]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileBoardTransformationFactory::class);
    }

    function it_should_factory_specification()
    {
        $profile = new Profile(new Name('test'), new Version('1.0'));
        $this->factory($profile)->shouldBeAnInstanceOf(Transformation::class);
    }

    function it_should_throw_exception_on_unknown_profile()
    {
        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(BoardTransformationNotFoundException::class)->during('factory', [$profile]);
    }
}
