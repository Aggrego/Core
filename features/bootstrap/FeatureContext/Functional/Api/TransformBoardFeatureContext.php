<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use RuntimeException;
use Tests\Profile\BoardFactory\Factory;
use TimiTao\Construo\Domain\Api\Command\TransformBoard\Command;
use TimiTao\Construo\Domain\Api\Command\TransformBoard\UseCase;

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
            $this->useCase->handle(new Command(Factory::DEFAULT_BOARD_UUID));
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
