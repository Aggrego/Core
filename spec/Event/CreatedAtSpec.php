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

use Aggrego\EventConsumer\Event\CreatedAt;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class CreatedAtSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new DateTimeImmutable());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedAt::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }
}
