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

namespace spec\Aggrego\DataDomainBoard\Board\Events;

use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\DataDomainBoard\Board\Events\BoardCreatedEvent;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Event\Name;
use PhpSpec\ObjectBehavior;

class BoardCreatedEventSpec extends ObjectBehavior
{
    function let(Id $id, Id $parentId)
    {
        $id->getValue()->willReturn('1');
        $parentId->getValue()->willReturn('2');
        $profile = ProfileName::createFromParts('test', '1.0');
        $data = new Data('test');
        $this->beConstructedThrough('build', [$id, $profile, $data, $parentId]);
    }

    function it_should_have_name()
    {
        $name = $this->getName();
        $name->shouldReturnAnInstanceOf(Name::class);
        $name->getValue()->shouldReturn(BoardCreatedEvent::class);
    }

    function it_should_have_schema()
    {
        $payload = $this->getPayload()->getValue();
        $payload->shouldHaveKey('id');
        $payload->shouldHaveKey('profile');
        $payload->shouldHaveKey('data');
        $payload->shouldHaveKey('parent_id');
    }
}
