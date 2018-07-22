<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use Iterator;
use TimiTao\Construo\Domain\Model\Board\Entity\Board as BaseBoard;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Shard;
use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class Board extends BaseBoard
{
    /** @var Shards */
    private $shards;

    protected function __construct(Key $key, Profile $profile, Shards $shards)
    {
        parent::__construct($key, $profile);
        $this->shards = $shards;
    }

    public static function factoryFromInitial(InitialBoard $board): self
    {
        $shardsList = [];
        /** @var Shard $shard */
        foreach ( $board->getShards() as $shard){
            $shardsList[] = new InitialShard(
                $shard->getUuid(),
                $shard->getAcceptableSource(),
                $shard->getKey()
            );
        }

        return new self(
            $board->getKey(),
            $board->getProfile(),
            new Shards($shardsList)
        );
    }

    public function getShards(): Iterator
    {
        return $this->shards->getIterator();
    }

    public function isAllShardsFinishProgress(): bool
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
