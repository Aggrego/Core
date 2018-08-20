<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Aggrego\Domain\Api\Domain\Command\TransformBoard\Command;
use Aggrego\Domain\Api\Domain\Command\TransformBoard\UseCase;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use RuntimeException;
use Tests\Profile\BoardConstruction\Builder;

class TransformBoardFeatureContext implements Context
{
    /** @var UseCase */
    private $useCase;

    /** @var RuntimeException */
    private $exception;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @When I command transform default board
     */
    public function iCommandTransformDefaultBoard()
    {
        try {
            $this->useCase->handle(new Command(Builder::DEFAULT_BOARD_UUID));
        } catch (RuntimeException $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then transform command should be rejected
     */
    public function transformCommandShouldBeRejected()
    {
        Assertion::isInstanceOf($this->exception, RuntimeException::class);
    }
}
