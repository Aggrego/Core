<?php

namespace Aggrego\Domain\Model\InitialBoard\Entity;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Aggrego\Domain\Model\Board\Entity\Board as BaseBoard;
use Aggrego\Domain\Model\InitialBoard\ValueObject\Shards;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Traversable;

class Board extends BaseBoard
{
    /** @var Shards */
    private $shards;

    public function __construct(Key $key, Profile $profile)
    {
        parent::__construct($key, $profile);
        $this->shards = new Shards();
    }

    public function getShards(): Traversable
    {
        return $this->shards->getIterator();
    }

    public function addShard(Key $key, Source $acceptableSource): void
    {
        $shardUuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $acceptableSource . $this->getUuid()->getValue()
            )->toString()
        );

        $this->shards->add(new Shard($shardUuid, $acceptableSource, $key));
    }
}
