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

declare(strict_types=1);

namespace spec\Aggrego\Infrastructure\Contract\Event\Shared;

use Aggrego\Infrastructure\Contract\Event\CreatedAt;
use Aggrego\Infrastructure\Contract\Event\Domain;
use Aggrego\Infrastructure\Contract\Event\Name;
use Aggrego\Infrastructure\Contract\Event\Payload;
use Aggrego\Infrastructure\Contract\Event\Shared\Event;
use Aggrego\Infrastructure\Contract\Event\Version;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    function let(Domain $domain, Name $name, CreatedAt $createdAt, Version $version, Payload $payload)
    {
        $this->beConstructedWith(
            $domain,
            $name,
            $createdAt,
            $version,
            $payload
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
        $this->getPayload()->shouldBeAnInstanceOf(Payload::class);
    }
}
