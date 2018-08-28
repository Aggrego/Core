<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Step\Steps;

use Aggrego\Domain\ProgressiveBoard\Shard\Collection;
use Aggrego\Domain\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\ProgressiveBoard\Step\Step;

final class ProgressStep implements Step
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

    public function canBeTransformed(): bool
    {
        return $this->shards->isAllShardsFinishedProgress();
    }
}
