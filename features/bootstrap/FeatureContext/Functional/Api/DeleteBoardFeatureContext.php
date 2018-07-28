<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Aggrego\Domain\Api\Command\DeleteBoard\Command;
use Aggrego\Domain\Api\Command\DeleteBoard\UseCase;
use Behat\Behat\Context\Context;
use Tests\Profile\BoardFactory\Factory;

class DeleteBoardFeatureContext implements Context
{
    /** @var UseCase */
    private $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @When I command delete default board
     */
    public function iCommandDeleteDefaultBoard()
    {
        $this->useCase->handle(
            new Command(Factory::DEFAULT_BOARD_UUID)
        );
    }

}
