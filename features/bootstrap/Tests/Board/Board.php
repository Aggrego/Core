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

namespace Tests\Board;

use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\Profile;
use Aggrego\EventConsumer\Shared\Events;
use Tests\Board\Events\BoardCreated;

class Board implements DomainBoard
{
    /**
     * @var Uuid
     */
    private $uuid;

    /**
     * @var Profile
     */
    private $profile;

    public function __construct(Uuid $uuid, Profile $profile)
    {
        $this->uuid = $uuid;
        $this->profile = $profile;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function pullEvents(): Events
    {
        $events = new Events();
        $events->add(new BoardCreated($this->uuid, $this->profile));
        return $events;
    }
}
