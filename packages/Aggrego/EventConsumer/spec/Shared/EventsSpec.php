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

use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Shared\Events;
use IteratorAggregate;
use PhpSpec\ObjectBehavior;

class EventsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Events::class);
        $this->shouldHaveType(IteratorAggregate::class);
    }

    function it_should_add_event(Event $event)
    {
        $this->add($event)->shouldBeNull();
    }
}
