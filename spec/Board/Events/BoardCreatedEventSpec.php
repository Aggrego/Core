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

namespace spec\Aggrego\DataBoard\Board\Events;

use Aggrego\AggregateEventConsumer\Event\Name;
use Aggrego\AggregateEventConsumer\Uuid;
use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Events\BoardCreatedEvent;
use Aggrego\DataBoard\Board\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class BoardCreatedEventSpec extends ObjectBehavior
{
    function let(Uuid $uuid, Uuid $parentUuid)
    {
        $uuid->getValue()->willReturn('69d53395-7c1d-452d-ab5c-921575980f16');
        $key = new Key(['test']);
        $profile = Profile::createFrom('test', '1.0');
        $metadata = new Metadata(new Data('test'));
        $parentUuid->getValue()->willReturn('69d53395-7c1d-452d-ab5c-921575980f16');
        $this->beConstructedWith($uuid, $key, $profile, $metadata, $parentUuid);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BoardCreatedEvent::class);
    }

    function it_should_have_name()
    {
        $name = $this->getName();
        $name->shouldReturnAnInstanceOf(Name::class);
        $name->getValue()->shouldReturn(BoardCreatedEvent::class);
    }

    function it_should_have_schema()
    {
        $payload = $this->getPayload();
        $payload->shouldHaveKey('uuid');
        $payload->shouldHaveKey('key');
        $payload->shouldHaveKey('profile');
        $payload->shouldHaveKey('metadata');
        $payload->shouldHaveKey('parent_uuid');
    }
}
