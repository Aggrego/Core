<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Aggrego\Domain\Api\Domain\Command\UpdateBoard\Command;
use Aggrego\Domain\Api\Domain\Command\UpdateBoard\UseCase;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use RuntimeException;
use Tests\Profile\BoardConstruction\Builder;

class UpdateBoardFeatureContext implements Context
{
    public const DEFAULT_DATA_UPDATE = 'string';

    /** @var UseCase */
    private $useCase;

    /** @var RuntimeException */
    private $exception;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @When I command update default board by default integration source with test string
     */
    public function iCommandUpdateDefaultBoardByDefaultIntegrationSourceWithTestString()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Builder::DEFAULT_BOARD_UUID,
                    Builder::DEFAULT_SHARD_MR_UUID,
                    Builder::DEFAULT_SOURCE_NAME,
                    Builder::DEFAULT_SOURCE_VERSION,
                    self::DEFAULT_DATA_UPDATE
                )
            );
        } catch (RuntimeException $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I command update default board by other integration source with test string
     */
    public function iCommandUpdateDefaultBoardByOtherIntegrationSourceWithTestString()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Builder::DEFAULT_BOARD_UUID,
                    Builder::DEFAULT_SHARD_MR_UUID,
                    'unknown',
                    Builder::DEFAULT_SOURCE_VERSION,
                    self::DEFAULT_DATA_UPDATE
                )
            );
        } catch (RuntimeException $e) {
            $this->exception = $e;
        }
    }


    /**
     * @Then update command should be rejected
     */
    public function newBoardShouldBeCreated(): void
    {
        Assertion::isInstanceOf($this->exception, RuntimeException::class);
    }
}
