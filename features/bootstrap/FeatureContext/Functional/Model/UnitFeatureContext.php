<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Model;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Domain\Model\Unit\Repository;

class UnitFeatureContext implements Context
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Then new unit should be created
     */
    public function newBoardShouldBeCreated(): void
    {
        Assertion::min(count($this->repository->getList()), 1);
    }
}
