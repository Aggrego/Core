<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Step;

use Aggrego\Domain\Model\ProgressiveBoard\Shard\Collection;
use Aggrego\Domain\Model\ProgressiveBoard\Shard\FinalItem;

class Step
{
    /** @var State */
    private $state;

    /** @var Collection */
    private $shards;

    public function __construct(State $state, Collection $shards)
    {
        $this->state = $state;
        $this->shards = $shards;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function replace(FinalItem $finalItem): void
    {
        $this->shards->replace($finalItem);
    }

    public function getShards(): Collection
    {
        return $this->shards;
    }

    public function isAllShardsFinishedProgress(): bool
    {
        return $this->shards->isAllShardsFinishedProgress();
    }
}
