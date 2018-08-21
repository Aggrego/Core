<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Model;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Board;
use Aggrego\Domain\ProgressiveBoard\Events\ShardAddedEvent;
use Aggrego\Domain\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use FeatureContext\Functional\Api\UpdateBoardFeatureContext;
use Tests\Domain\ProgressiveBoard\Repository;
use Tests\Profile\BoardConstruction\Builder as TestBuilder;
use Tests\Profile\BoardConstruction\Watchman;

class ProgressBoardFeatureContext implements Context
{
    /** @var Repository */
    private $repository;

    /** @var TestBuilder */
    private $builder;

    public function __construct(Repository $repository, Watchman $watchman)
    {
        $this->repository = $repository;
        $this->builder = $watchman->passBuilder(
            Profile::createFrom(TestBuilder::DEFAULT_SOURCE_NAME, TestBuilder::DEFAULT_SOURCE_VERSION)
        );
    }

    /**
     * @Given no board exists
     */
    public function noBoardExists(): void
    {
        $this->repository->clear();
    }

    /**
     * @Given default board exists
     */
    public function defaultBoardExists()
    {
        $this->repository->addBoard(
            Board::factory(new Key(TestBuilder::DEFAULT_KEY), $this->builder)
        );
    }

    /**
     * @Given default board fully updated exist
     */
    public function defaultBoardFullyUpdated()
    {
        $board = Board::factory(new Key(TestBuilder::DEFAULT_KEY), $this->builder);
        $board->updateShard(
            new Uuid(TestBuilder::DEFAULT_SHARD_MR_UUID),
            Profile::createFrom(TestBuilder::DEFAULT_SOURCE_NAME, TestBuilder::DEFAULT_SOURCE_VERSION),
            new Data(UpdateBoardFeatureContext::DEFAULT_DATA_UPDATE)
        );
        $board->updateShard(
            new Uuid(TestBuilder::DEFAULT_SHARD_MRS_UUID),
            Profile::createFrom(TestBuilder::DEFAULT_SOURCE_NAME, TestBuilder::DEFAULT_SOURCE_VERSION),
            new Data(UpdateBoardFeatureContext::DEFAULT_DATA_UPDATE)
        );
        $this->repository->addBoard($board);
    }


    /**
     * @Then new board should be created
     */
    public function newBoardShouldBeCreated(): void
    {
        Assertion::min(count($this->repository->getList()), 1);
    }

    /**
     * @Then have shards initialized
     */
    public function haveShardsInitialized()
    {
        $list = $this->repository->getList();
        /** @var Board $element */
        $element = reset($list);

        $count = [];
        /** @var Board $board */
        foreach ($element->pullEvents() as $event) {
            if (!isset($count[get_class($event)])) {
                $count[get_class($event)] = 0;
            }
            $count[get_class($event)]++;
        }
        Assertion::eq($count[ShardAddedEvent::class], TestBuilder::INITIAL_SHARDS_COUNT, print_r($element, true));
    }

    /**
     * @Then default board should have updated shards
     */
    public function defaultBoardShouldHaveUpdatedShard()
    {
        $list = $this->repository->getList();
        /** @var Board $element */
        $element = reset($list);

        $count = [];
        foreach ($element->getShards() as $shard) {
            $className = get_class($shard);
            if (!isset($count[$className])) {
                $count[$className] = 0;
            }
            $count[$className] += 1;
        }

        Assertion::min($count[FinalItem::class], 1);
    }

    /**
     * @Then default board shouldn't have updated shards
     */
    public function defaultBoardShouldntHaveUpdatedShards()
    {
        $list = $this->repository->getList();
        /** @var Board $element */
        $element = reset($list);

        $count = [];
        foreach ($element->getShards() as $shard) {
            $className = get_class($shard);
            if (!isset($count[$className])) {
                $count[$className] = 0;
            }
            $count[get_class($shard)] += 1;
        }

        Assertion::keyNotExists($count, FinalItem::class);
    }

    /**
     * @Then should no board exist
     */
    public function shouldNoBoardExist()
    {
        $oneMarkedAsDeleted = false;
        /** @var Board $board */
        foreach ($this->repository->getList() as $board) {
            foreach ($board->pullEvents() as $event) {
                if ($event instanceof BoardDeletedEvent) {
                    $oneMarkedAsDeleted = true;
                }
            }
        }
        Assertion::true($oneMarkedAsDeleted);
    }
}
