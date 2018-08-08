<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Model;

use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\ProgressBoard\Entity\FinalItem;
use Aggrego\Domain\Model\ProgressBoard\Events\BoardDeletedEvent;
use Aggrego\Domain\Profile\BoardFactory\Factory as BoardFactory;
use Aggrego\Domain\ValueObject\Data;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use FeatureContext\Functional\Api\UpdateBoardFeatureContext;
use Tests\Domain\Model\ProgressBoard\Repository;
use Tests\Profile\BaseTestSupport;
use Tests\Profile\BoardFactory\Factory;
use Tests\Profile\KeySpecification\Specification;

class ProgressBoardFeatureContext implements Context
{
    /** @var Repository */
    private $repository;

    /** @var BoardFactory */
    private $boardFactory;

    public function __construct(Repository $repository, BoardFactory $boardFactory)
    {
        $this->repository = $repository;
        $this->boardFactory = $boardFactory;
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
        $initialBoard = $this->boardFactory->factory(
            new Key(Specification::DEFAULT_KEY),
            new Profile(
                new Name(BaseTestSupport::DEFAULT_PROFILE),
                new Version(BaseTestSupport::DEFAULT_VERSION)
            )
        );
        $board = Board::factoryFromInitial($initialBoard);
        $this->repository->addBoard($board);
    }

    /**
     * @Given default board fully updated exist
     */
    public function defaultBoardFullyUpdated()
    {
        $initialBoard = $this->boardFactory->factory(
            new Key(Specification::DEFAULT_KEY),
            new Profile(
                new Name(BaseTestSupport::DEFAULT_PROFILE),
                new Version(BaseTestSupport::DEFAULT_VERSION)
            )
        );
        $board = Board::factoryFromInitial($initialBoard);
        $board->updateShard(
            new Uuid(Factory::DEFAULT_SHARD_MR_UUID),
            new Source(new Name(Factory::DEFAULT_SOURCE_NAME), new Version(Factory::DEFAULT_SOURCE_VERSION)),
            new Data(UpdateBoardFeatureContext::DEFAULT_DATA_UPDATE)
        );
        $board->updateShard(
            new Uuid(Factory::DEFAULT_SHARD_MRS_UUID),
            new Source(new Name(Factory::DEFAULT_SOURCE_NAME), new Version(Factory::DEFAULT_SOURCE_VERSION)),
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

        Assertion::count($element->getShards(), Factory::INITIAL_SHARDS_COUNT);
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
            if (!isset($count[$className])){
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
            if (!isset($count[$className])){
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
