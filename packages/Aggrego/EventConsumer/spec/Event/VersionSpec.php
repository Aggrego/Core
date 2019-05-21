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

namespace spec\Aggrego\EventConsumer\Event;

use Aggrego\EventConsumer\Event\Version;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class VersionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('1');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Version::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_should_throw_exception_with_invalid_format()
    {
        $this->beConstructedWith('1-dev');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
