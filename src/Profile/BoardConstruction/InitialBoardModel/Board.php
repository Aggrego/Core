<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel;

use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Collection;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Item;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Traversable;

class Board
{
    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Collection */
    private $shards;

    protected function __construct(Key $key, Profile $profile)
    {
        $this->uuid = $this->produceUuid($key, $profile);
        $this->key = $key;
        $this->profile = $profile;
        $this->shards = new Collection();
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

    public function getShards(): Traversable
    {
        return $this->shards->getIterator();
    }

    public function addShard(Key $key, Profile $shardProfile): void
    {
        $this->shards->add(
            new Item(
                $this->produceShardUuid($key, $shardProfile),
                $shardProfile,
                $key
            )
        );
    }

    private function produceUuid(Key $key, Profile $profile): Uuid
    {
        return new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile
            )->toString()
        );
    }

    private function produceShardUuid(Key $key, Profile $shardProfile): Uuid
    {
        return new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $shardProfile . $this->getUuid()->getValue()
            )->toString()
        );
    }
}
