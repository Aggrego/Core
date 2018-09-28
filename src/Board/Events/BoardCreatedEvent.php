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

namespace Aggrego\DataBoard\Board\Events;

use Aggrego\AggregateEventConsumer\Shared\Event;
use Aggrego\AggregateEventConsumer\Uuid;
use Aggrego\DataBoard\Board\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;

class BoardCreatedEvent extends Event
{
    public function __construct(Uuid $uuid, Key $key, Profile $profile, Metadata $metadata, ?Uuid $parentUuid)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'key' => $key->getValue(),
                'profile' => $profile->__toString(),
                'metadata' => $metadata->getData()->getValue(),
                'parent_uuid' => $parentUuid ? $parentUuid->getValue() : null,
            ]
        );
    }
}
