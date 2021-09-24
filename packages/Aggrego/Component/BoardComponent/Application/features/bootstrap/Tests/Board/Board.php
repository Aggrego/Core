<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Board;

use Aggrego\Component\BoardComponent\Domain\Board\Board as DomainBoard;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;
use Aggrego\Component\BoardComponent\Domain\Board\Name;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Name as ProfileName;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\TransformationProfile;
use Aggrego\Infrastructure\Event\Shared\Events;
use Tests\Board\Events\BoardCreated;

class Board implements DomainBoard
{
    private $id;

    private $name;

    private $profile;

    public function __construct(Id $id, ProfileName $profile)
    {
        $this->id = $id;
        $this->name = new Name('test');
        $this->profile = $profile;
    }

    public function pullEvents(): Events
    {
        $events = new Events();
        $events->add(BoardCreated::build($this->id, $this->profile));
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
