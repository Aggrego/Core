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

use Aggrego\Application\Board\Id\Uuid;
use Aggrego\Domain\Profile\Name;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use FeatureContext\Functional\Api\CreateBoardFeatureContext;
use Tests\Board\Board;
use Tests\Board\TestBoardRepository;
use Tests\Profile\Building\TestBuildingProfile;

class BoardFeatureContext implements Context
{
    /**
     * @var TestBoardRepository
     */
    private $repository;

    public function __construct(TestBoardRepository $repository)
    {
        $this->repository = $repository;
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
            new Board(
                new Uuid(CreateBoardFeatureContext::DEFAULT_UUID),
                Name::createFromParts(TestBuildingProfile::NAME, TestBuildingProfile::VERSION))
        );
    }

    /**
     * @Then new board should be created
     */
    public function newBoardShouldBeCreated(): void
    {
        Assertion::min(count($this->repository->getList()), 1);
    }
//
//    private function mapEventsCountForFirstBoard(): array
//    {
//        $list = $this->repository->getList();
//        /**
//         * @var Board $element
//         */
//        $element = reset($list);
//        return $this->mapEventsCount($element);
//    }
//
//    private function mapEventsCount(Board $board): array
//    {
//        $count = [];
//        /**
//         * @var Board $board
//         */
//        foreach ($board->pullEvents() as $event) {
//            if (!isset($count[get_class($event)])) {
//                $count[get_class($event)] = 0;
//            }
//            $count[get_class($event)]++;
//        }
//        return $count;
//    }
}
