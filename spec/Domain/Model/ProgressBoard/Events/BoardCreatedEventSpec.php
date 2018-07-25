<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Events;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board;
use TimiTao\Construo\Domain\Model\ProgressBoard\Events\BoardCreatedEvent;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

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
