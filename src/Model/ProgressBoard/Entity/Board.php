<?php

namespace Aggrego\Domain\Model\ProgressBoard\Entity;

use Aggrego\Domain\Event\Aggregate;
use Aggrego\Domain\Event\Model\Entity\TraitAggregate;
use Aggrego\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use Aggrego\Domain\Model\InitialBoard\Entity\Shard;
use Aggrego\Domain\Model\ProgressBoard\Events\BoardCreatedEvent;
use Aggrego\Domain\Model\ProgressBoard\Events\ShardAddedEvent;
use Aggrego\Domain\Model\ProgressBoard\Events\ShardUpdatedEvent;
use Aggrego\Domain\Model\ProgressBoard\ValueObject\Shards;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

class Board implements Aggregate
{
    use TraitAggregate;

    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Shards */
    private $shards;

    private function __construct(Uuid $uuid, Key $key, Profile $profile, Shards $shards)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->shards = $shards;

        $this->pushEvent(new BoardCreatedEvent($this));
        foreach ($shards as $shard) {
            $this->pushEvent(new ShardAddedEvent($shard));
        }
    }

    public static function factoryFromInitial(InitialBoard $board): self
    {
        $shardsList = [];
        /** @var Shard $shard */
        foreach ($board->getShards() as $shard) {
            $shardsList[] = new InitialShard(
                $shard->getUuid(),
                $shard->getAcceptableSource(),
                $shard->getKey()
            );
        }

        return new self(
            $board->getUuid(),
            $board->getKey(),
            $board->getProfile(),
            new Shards($shardsList)
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

    public function getShards(): Shards
    {
        return $this->shards;
    }

    public function isAllShardsFinishedProgress(): bool
    {
        foreach ($this->shards as $shard) {
            if ($shard instanceof InitialShard) {
                return false;
            }
        }
        return true;
    }

    public function updateShard(Uuid $shardUuid, Source $source, Data $data): void
    {
        $shard = new FinalShard($shardUuid, $source, $data);
        $this->shards->replace($shard);
        $this->pushEvent(new ShardUpdatedEvent($shard));
    }
}
