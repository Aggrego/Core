<?php

declare(strict_types = 1);

namespace FeatureContext\Functional;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Domain\Model\Board\Repository;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;

class BoardFeatureContext implements Context
{
    public const DEFAULT_KEY = ['key' => 'init'];

    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
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
     * @Then new board should be created
     */
    public function newBoardShouldBeCreated(): void
    {
        Assertion::min(count($this->repository->getList()), 1);
    }

    /**
     * @Then new board should have initial status
     */
    public function newBoardShouldHaveInitialStatus(): void
    {
        $list = $this->repository->getList();
        /** @var Board $element */
        $element = reset($list);
        Assertion::eq('initial', $element->getStatus()->getValue());
    }

    /**
     * @Then have shards initialized
     */
    public function haveShardsInitialized()
    {
        $list = $this->repository->getList();
        /** @var Board $element */
        $element = reset($list);

        Assertion::count($element->getShards(), 1);
    }

}
