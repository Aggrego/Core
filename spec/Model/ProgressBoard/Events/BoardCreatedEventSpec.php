<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\Events;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\Event\Event;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\ProgressBoard\Events\BoardCreatedEvent;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;

class BoardCreatedEventSpec extends ObjectBehavior
{
    function let(Board $board)
    {
        $board->getUuid()->willReturn(new Uuid('test'));
        $board->getKey()->willReturn(new Key(['test']));
        $board->getProfile()->willReturn(new Profile(new Name('test'), new Version('1.0')));
        $this->beConstructedWith($board);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BoardCreatedEvent::class);
        $this->shouldImplement(Event::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeString();
    }

    function it_should_have_payload()
    {
        $payload = $this->getPayload();
        $payload->shouldBeArray();
        $payload->shouldHaveKey('uuid');
        $payload->shouldHaveKey('key');
        $payload->shouldHaveKey('profile');
    }
}
