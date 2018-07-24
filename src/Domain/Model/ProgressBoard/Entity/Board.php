<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use Iterator;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Shard;
use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class Board
{
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
        $this->shards->replace(new FinalShard($shardUuid, $source, $data));
    }
}
