<?php

namespace spec\TimiTao\Construo\Domain\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;
use TimiTao\Construo\Domain\Factory\ProfileKeySpecificationFactory;
use TimiTao\Construo\Domain\Profile\KeySpecification\Specification;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

class ProfileKeySpecificationFactorySpec extends ObjectBehavior
{
    function let(Specification $specification)
    {
        $profile = Argument::type(Profile::class);
        $specification->isSupported($profile)->willReturn(true);
        $this->beConstructedWith([$specification]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProfileKeySpecificationFactory::class);
    }

    function it_should_factory_specification()
    {
        $profile = new Profile(new Name('test'), new Version('1.0'));
        $this->factory($profile)->shouldBeAnInstanceOf(Specification::class);
    }

    function it_should_throw_exception_on_unknown_profile(Specification $specification)
    {
        $profile = Argument::type(Profile::class);
        $specification->isSupported($profile)->willReturn(false);
        $this->beConstructedWith([$specification]);

        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(KeySpecificationNotFoundException::class)->during('factory', [$profile]);
    }
}
