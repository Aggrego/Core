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

namespace Aggrego\DataDomainBoard\Board;

use Aggrego\DataDomainBoard\Board\Events\BoardCreatedEvent;
use Aggrego\DataDomainBoard\Board\Prototype\Metadata;
use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\Profile;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Shared\Events;

class Board implements DomainBoard
{
    /** @var Events */
    protected $events;

    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Metadata */
    private $metadata;

    public function __construct(Uuid $uuid, Key $key, Profile $profile, Metadata $metadata, ?Uuid $parentUuid)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->metadata = $metadata;
        $this->events = new Events();
        $this->pushEvent(BoardCreatedEvent::build($uuid, $key, $profile, $metadata, $parentUuid));
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    public function pullEvents(): Events
    {
        $list = $this->events;
        $this->events = new Events();
        return $list;
    }

    protected function pushEvent(Event $event): void
    {
        $this->events->add($event);
    }
}
