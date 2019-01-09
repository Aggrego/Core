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

use Aggrego\EventConsumer\Event\Name;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Name::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_should_throw_exception_with_invalid_format()
    {
        $this->beConstructedWith('');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
