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

use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Uuid;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class DomainSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Name('test'), new Uuid('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Domain::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }

    function it_could_be_constructed_from_parts()
    {
        $this->beConstructedThrough('build', ['test1', '7835a2f1-65c4-4e05-aacf-2e9ed950f5f2']);
        $this->getValue()->shouldReturn('test1:7835a2f1-65c4-4e05-aacf-2e9ed950f5f2');
    }

    function it_should_throw_exception_constructed_from_wrong_parts()
    {
        $this->beConstructedThrough('fromString', ['']);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }
}
