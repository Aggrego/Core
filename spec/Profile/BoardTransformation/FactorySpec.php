<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Exception\TransformationNotFoundException;
use Aggrego\Domain\Profile\BoardTransformation\Factory;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\Profile\BoardTransformation\Watchman;
use Aggrego\Domain\Profile\Profile;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;

class FactorySpec extends ObjectBehavior
{
    function let(Watchman $watchman, Transformation $transformation)
    {
        $profile = Profile::createFromParts('test', '1.0');
        $watchman->isSupported($profile)->willReturn(true);
        $watchman->passTransformation($profile)->willReturn($transformation);
        $this->beConstructedWith([$watchman]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_should_factory_board_factory()
    {
        $profile = Profile::createFromParts('test', '1.0');
        $this->factory($profile)->shouldBeAnInstanceOf(Transformation::class);
    }

    function it_should_throw_exception_on_unknown_profile(Watchman $watchman)
    {
        $profile = Argument::type(Profile::class);
        $watchman->isSupported($profile)->willReturn(false);
        $this->beConstructedWith([$watchman]);

        $profile = Profile::createFromParts('unknown', '1.0');
        $this->shouldThrow(TransformationNotFoundException::class)->during('factory', [$profile]);
    }

    function it_should_throw_exception_on_wrong_watchmen_initialization()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
