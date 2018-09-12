<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard;

use Aggrego\Domain\Profile\BoardConstruction\Builder;
use Aggrego\Domain\Profile\BoardTransformation\Factory as BoardTransformationFactory;
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
use Aggrego\Domain\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\ProgressStep;
use Aggrego\Domain\Shared\Event\Model\TraitAggregate;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Aggrego\EventStore\Aggregate;
use Ramsey\Uuid\Uuid as RamseyUuid;

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

        $this->pushEvent(new BoardCreatedEvent($uuid, $key, $profile));
        $this->setStep($step);
    }

    public static function factory(Key $key, Builder $factory): self
    {
        $initialBoard = $factory->build($key);
        $key = $initialBoard->getKey();
        $profile = $initialBoard->getProfile();

        $uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile
            )->toString()
        );

        return new self(
            $uuid,
            $key,
            $profile,
            $initialBoard->getStep()
        );
    }

    public static function transformBoard(Board $board, BoardTransformationFactory $transformation): Board
    {
        if ($board->isDeleted) {
            throw new UnprocessableBoardException();
        }

        if (!$board->step instanceof ProgressStep) {
            throw new UnprocessableBoardException();
        }

        if (!$board->step->readyToTransformation()) {
            throw new UnfinishedStepPassedForTransformationException();
        }

        $key = $board->key;
        $profile = $board->profile;

        $uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile . $board->uuid->getValue()
            )->toString()
        );

        return new self(
            $uuid,
            $key,
            $profile,
            $transformation->factory($profile)->process($board->step)
        );
    }

    public function updateShard(Uuid $shardUuid, Profile $profile, Data $data): void
    {
        if ($this->isDeleted) {
            throw new UnprocessableBoardException();
        }

        if (!$this->step instanceof ProgressStep) {
            throw new UnprocessableBoardException();
        }

        $shard = new FinalItem($shardUuid, $profile, $data);
        $this->step->replace($shard);
        $this->pushEvent(new ShardUpdatedEvent($this->uuid, $shard));
        if ($this->step->readyToTransformation()) {
            $this->pushEvent(new UpdatedLastStepsShardEvent($this->uuid));
        }
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    private function setStep(Step $step): void
    {
        if ($step->getState()->isFinal()) {
            /** @var FinalStep $step */
            $this->setFinalStep($step);
        } else {
            /** @var ProgressStep $step */
            $this->setProgressStep($step);
        }
    }

    private function setFinalStep(FinalStep $step): void
    {
        $this->step = $step;
        $this->pushEvent(new FinalBoardTransformedEvent($this->uuid, $step));

        $this->isDeleted = true;
        $this->pushEvent(new BoardDeletedEvent($this->uuid));
    }

    private function setProgressStep(ProgressStep $step): void
    {
        $this->step = $step;
        foreach ($step->getShards() as $shard) {
            $this->pushEvent(new ShardAddedEvent($this->uuid, $shard));
        }

        /** @var ProgressStep $step */
        $this->pushEvent(new BoardTransformedEvent($this->uuid, $step));
    }
}
