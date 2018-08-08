<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard;

use Aggrego\Domain\Api\Application\Event\Aggregate;
use Aggrego\Domain\Api\Application\Profile\BoardConstruction\Builder;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\Model\ProgressiveBoard\Events\BoardCreatedEvent;
use Aggrego\Domain\Model\ProgressiveBoard\Events\BoardDeletedEvent;
use Aggrego\Domain\Model\ProgressiveBoard\Events\ShardAddedEvent;
use Aggrego\Domain\Model\ProgressiveBoard\Events\ShardUpdatedEvent;
use Aggrego\Domain\Model\ProgressiveBoard\Events\UpdatedLastStepsShardEvent;
use Aggrego\Domain\Model\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Model\ProgressiveBoard\Shard\Collection;
use Aggrego\Domain\Model\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\Model\ProgressiveBoard\Shard\InitialItem;
use Aggrego\Domain\Model\ProgressiveBoard\Step\State;
use Aggrego\Domain\Model\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\Event\Model\TraitAggregate;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class Board implements Aggregate
{
    use TraitAggregate;

    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Step */
    private $step;

    /** @var bool */
    private $isDeleted;

    private function __construct(Uuid $uuid, Key $key, Profile $profile, Step $step)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->step = $step;

        $this->pushEvent(new BoardCreatedEvent($this));
        foreach ($step->getShards() as $shard) {
            $this->pushEvent(new ShardAddedEvent($shard));
        }
    }

    public static function factory(Key $key, Builder $factory): self
    {
        $initialBoard = $factory->build($key);

        $shardsList = [];
        /** @var InitialItem $item */
        foreach ($initialBoard->getShards() as $item) {
            $shardsList[] = new InitialItem(
                $item->getUuid(),
                $item->getProfile(),
                $item->getKey()
            );
        }

        return new self(
            $initialBoard->getUuid(),
            $initialBoard->getKey(),
            $initialBoard->getProfile(),
            new Step(State::createInitial(), new Collection($shardsList))
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

    public function getStep(): Step
    {
        return $this->step;
    }

    public function updateShard(Uuid $shardUuid, Profile $profile, Data $data): void
    {
        $shard = new FinalItem($shardUuid, $profile, $data);
        $this->step->replace($shard);
        $this->pushEvent(new ShardUpdatedEvent($shard));
        if ($this->isStepReadyForNextTransformation()) {
            $this->pushEvent(new UpdatedLastStepsShardEvent());
        }
    }

    public function markAsDeleted(): void
    {
        $this->isDeleted = true;
        $this->pushEvent(new BoardDeletedEvent());
    }

    public function isStepReadyForNextTransformation(): bool
    {
        return $this->step->isAllShardsFinishedProgress();
    }

    public function transformStep(Transformation $transformation): void
    {
        if (!$this->isStepReadyForNextTransformation()) {
            throw new UnfinishedStepPassedForTransformationException();
        }

        $this->step = $transformation->process($this->step);
    }
}
