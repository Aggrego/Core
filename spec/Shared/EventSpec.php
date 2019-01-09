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

namespace spec\Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;
use Aggrego\EventConsumer\Shared\Event;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            Domain::build('test', '7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'),
            new Name('test'),
            new CreatedAt(new DateTimeImmutable()),
            new Version('1.0'),
            []
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }

    function it_should_have_domain()
    {
        $this->getDomain()->shouldBeAnInstanceOf(Domain::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_should_have_created_time()
    {
        $this->createdAt()->shouldBeAnInstanceOf(CreatedAt::class);
    }

    function it_should_have_version()
    {
        $this->getVersion()->shouldBeAnInstanceOf(Version::class);
    }

    function it_should_have_payload()
    {
        $this->getPayload()->shouldBeArray();
    }
}
