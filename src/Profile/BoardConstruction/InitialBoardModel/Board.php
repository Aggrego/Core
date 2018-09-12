<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel;

use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Collection;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Item;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Shard\Collection as ModelCollection;
use Aggrego\Domain\ProgressiveBoard\Shard\InitialItem;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\ProgressStep;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Traversable;

class Board implements \Aggrego\Domain\Profile\BoardConstruction\Board
{
    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Collection */
    private $shards;

    public function __construct(Key $key, Profile $profile)
    {
        $this->key = $key;
        $this->profile = $profile;
        $this->shards = new Collection();
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
        $this->shards->add(new Item($shardProfile, $key));
    }

    public function getStep(): Step
    {
        $shardsList = [];
        /** @var Item $item */
        foreach ($this->getShards() as $item) {
            $shardsList[] = new InitialItem($item->getProfile(), $item->getKey());
        }

        return new ProgressStep(State::createInitial(), new ModelCollection($shardsList));
    }
}
