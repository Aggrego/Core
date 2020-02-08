<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\DataDomainBoard\Board;

use Aggrego\DataDomainBoard\Board\Events\BoardCreatedEvent;
use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Board\Name;
use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;
use Aggrego\Infrastructure\Event\Shared\Events;

final class Board implements DomainBoard
{
    private $events;

    private $id;

    private $name;

    private $profileName;

    private $parentId;

    private $data;

    public function __construct(Id $id, Name $name, ProfileName $profileName, ?Id $parentId, Data $data)
    {
        $this->id = $id;
        $this->name = $name;
        $this->profileName = $profileName;
        $this->parentId = $parentId;
        $this->data = $data;
        $this->events = new Events();
        $this->events->add(BoardCreatedEvent::build($id, $profileName, $data, $parentId));
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function pullEvents(): Events
    {
        $list = $this->events;
        $this->events = new Events();
        return $list;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getProfileName(): ProfileName
    {
        return $this->profileName;
    }

    public function getParentId(): ?Id
    {
        return $this->parentId;
    }

    public function getData(): Data
    {
        return $this->data;
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
