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

namespace Aggrego\DataBoard\Board;

use Aggrego\AggregateEventConsumer\Shared\TraitAggregate;
use Aggrego\AggregateEventConsumer\Uuid;
use Aggrego\DataBoard\Board\Events\BoardCreatedEvent;
use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;

class Board implements DomainBoard
{
    use TraitAggregate;

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

        $this->pushEvent(new BoardCreatedEvent($uuid, $key, $profile, $metadata, $parentUuid));
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
}
