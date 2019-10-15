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

use Aggrego\Application\Board\Id\Uuid;
use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Board\Name;
use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;
use Aggrego\EventConsumer\Shared\Events;
use Tests\Board\Events\BoardCreated;

class Board implements DomainBoard
{
    private $id;

    private $name;

    private $profile;

    public function __construct(Id $uuid, ProfileName $profile)
    {
        $this->id = $uuid;
        $this->name = new Name('test');
        $this->profile = $profile;
    }

    public function pullEvents(): Events
    {
        $events = new Events();
        $events->add(new BoardCreated($this->uuid, $this->profile));
        return $events;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getProfileName(): ProfileName
    {
        return $this->profile;
    }

    /**
     * @throws UnprocessableKeyChange
     * @throws UnprocessableBoard
     */
    public function transform(KeyChange $key, TransformationProfile $transformation): Prototype
    {
        return $transformation->transform($key, $this);
    }
}
