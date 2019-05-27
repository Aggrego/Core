<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace FeatureContext\Functional\Board;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Board\Board;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Board\Repository;
use Tests\Profile\BaseTestWatchman;
use Tests\Profile\BoardConstruction\Builder as TestBuilder;
use Tests\Profile\BoardConstruction\Watchman;

class BoardFeatureContext implements Context
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var TestBuilder
     */
    private $builder;

    public function __construct(Repository $repository, Watchman $watchman)
    {
        $this->repository = $repository;
        $this->builder = $watchman->passBuilder(
            Profile::createFromParts(BaseTestWatchman::DEFAULT_PROFILE, BaseTestWatchman::DEFAULT_VERSION)
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
        $count = $this->mapEventsCountForFirstBoard();
        Assertion::keyExists($count, ShardAddedEvent::class);
        Assertion::eq($count[ShardAddedEvent::class], TestBuilder::INITIAL_SHARDS_COUNT, print_r($count, true));
    }

    /**
     * @Then default board should have updated shards
     */
    public function defaultBoardShouldHaveUpdatedShard()
    {
        $count = $this->mapEventsCountForFirstBoard();
        Assertion::min($count[ShardUpdatedEvent::class], 1, print_r($count, true));
    }

    /**
     * @Then default board shouldn't have updated shards
     */
    public function defaultBoardShouldntHaveUpdatedShards()
    {
        $count = $this->mapEventsCountForFirstBoard();
        Assertion::keyNotExists($count, ShardUpdatedEvent::class);
    }

    /**
     * @Then should no board exist
     */
    public function shouldNoBoardExist()
    {
        $count = $this->mapEventsCountForFirstBoard();
        Assertion::min($count[BoardDeletedEvent::class], 1, print_r($count, true));
    }

    /**
     * @When board should be in final state
     */
    public function boardShouldBeInFinalState()
    {
        $count = $this->mapEventsCountForFirstBoard();
        Assertion::min($count[FinalBoardTransformedEvent::class], 1, print_r($count, true));
    }


    private function mapEventsCountForFirstBoard(): array
    {
        $list = $this->repository->getList();
        /**
 * @var Board $element
*/
        $element = reset($list);
        return $this->mapEventsCount($element);
    }

    private function mapEventsCount(Board $board): array
    {
        $count = [];
        /**
 * @var Board $board
*/
        foreach ($board->pullEvents() as $event) {
            if (!isset($count[get_class($event)])) {
                $count[get_class($event)] = 0;
            }
            $count[get_class($event)]++;
        }
        return $count;
    }
}
