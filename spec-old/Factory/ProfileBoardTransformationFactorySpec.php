<?php

namespace spec\Aggrego\Domain\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Aggrego\Domain\Exception\BoardTransformationNotFoundException;
use Aggrego\Domain\Factory\ProfileBoardTransformationFactory;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

class ProfileBoardTransformationFactorySpec extends ObjectBehavior
{
    function let(Transformation $transformation)
    {
        $profile = Argument::type(Profile::class);
        $transformation->isSupported($profile)->willReturn(true);
        $this->beConstructedWith([$transformation]);
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

    function it_should_throw_exception_on_unknown_profile(Transformation $transformation)
    {
        $profile = Argument::type(Profile::class);
        $transformation->isSupported($profile)->willReturn(false);
        $this->beConstructedWith([$transformation]);
        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(BoardTransformationNotFoundException::class)->during('factory', [$profile]);
    }
}
