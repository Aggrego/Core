<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard;

use Aggrego\Domain\Api\Application\Event\Aggregate;
use Aggrego\Domain\Profile\BoardConstruction\Builder;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Events\BoardCreatedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\BoardDeletedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\BoardTransformedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\FinalBoardTransformedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\ShardAddedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\ShardUpdatedEvent;
use Aggrego\Domain\ProgressiveBoard\Events\UpdatedLastStepsShardEvent;
use Aggrego\Domain\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\ProgressiveBoard\Exception\UnprocessableBoardException;
use Aggrego\Domain\ProgressiveBoard\Shard\Collection;
use Aggrego\Domain\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\ProgressiveBoard\Shard\InitialItem;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\ProgressStep;
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

    private function __construct(Uuid $uuid, Key $key, Profile $profile, ProgressStep $step)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->step = $step;

        $this->pushEvent(new BoardCreatedEvent($uuid, $key, $profile));
        $this->setStep($step);
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
            new ProgressStep(State::createInitial(), new Collection($shardsList))
        );
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function updateShard(Uuid $shardUuid, Profile $profile, Data $data): void
    {
        if ($this->isDeleted) {
            throw new UnprocessableBoardException();
        }
        $shard = new FinalItem($shardUuid, $profile, $data);
        $this->step->replace($shard);
        $this->pushEvent(new ShardUpdatedEvent($this->uuid, $shard));
        if ($this->isStepReadyForNextTransformation()) {
            $this->pushEvent(new UpdatedLastStepsShardEvent($this->uuid));
        }
    }

    public function transformStep(Transformation $transformation): void
    {
        if ($this->isDeleted) {
            throw new UnprocessableBoardException();
        }

        if (!$this->isStepReadyForNextTransformation()) {
            throw new UnfinishedStepPassedForTransformationException();
        }

        $step = $transformation->process($this->step);

        if ($step->getState()->isFinal()) {
            /** @var FinalStep $step */
            $this->step = $step;
            $this->pushEvent(new FinalBoardTransformedEvent($this->uuid, $step));

            $this->isDeleted = true;
            $this->pushEvent(new BoardDeletedEvent($this->uuid));
        } else {
            /** @var ProgressStep $step */
            $this->pushEvent(new BoardTransformedEvent($this->uuid, $step));
            $this->setStep($step);
        }
    }

    private function isStepReadyForNextTransformation(): bool
    {
        if ($this->isDeleted) {
            return false;
        }
        return $this->step->isReadyForTransformation();
    }

    private function setStep(ProgressStep $step): void
    {
        $this->step = $step;
        foreach ($step->getShards() as $shard) {
            $this->pushEvent(new ShardAddedEvent($this->uuid, $shard));
        }
    }
}
