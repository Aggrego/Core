<?php

namespace Aggrego\Domain\Model\Unit\Entity;

use Aggrego\Domain\Event\Aggregate;
use Aggrego\Domain\Event\Model\Entity\TraitAggregate;
use Aggrego\Domain\Exception\UnprocessableBoardException;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\Unit\Events\UnitCreatedEvent;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Uuid;

class Unit implements Aggregate
{
    use TraitAggregate;

    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    private function __construct(Uuid $uuid, Key $key, Profile $profile, Data $data)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->data = $data;

        $this->pushEvent(new UnitCreatedEvent($this));
    }

    public static function createFromBoard(Board $board, Transformation $transformation): self
    {
        if (!$board->isAllShardsFinishedProgress()) {
            throw new UnprocessableBoardException(
                sprintf(
                    'Can\'t process board %s that have shards in initial state',
                    $board->getUuid()->getValue()
                )
            );
        }
        return new Unit(
            $board->getUuid(),
            $board->getKey(),
            $board->getProfile(),
            $transformation->process($board->getShards())
        );
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
