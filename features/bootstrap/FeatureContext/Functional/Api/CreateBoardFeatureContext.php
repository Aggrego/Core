<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use RuntimeException;
use Tests\Profile\BaseTestSupport;
use Tests\Profile\KeySpecification\Specification;
use Throwable;
use Aggrego\Domain\Api\Command\CreateBoard\Command;
use Aggrego\Domain\Api\Command\CreateBoard\UseCase;

class CreateBoardFeatureContext implements Context
{
    /** @var UseCase */
    private $useCase;

    /** @var Throwable */
    private $exception;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @When I create board for by default key, profile and version
     */
    public function iCreateBoardForByDefaultKeyProfileAndVersion()
    {
        $this->useCase->handle(
            new Command(
                Specification::DEFAULT_KEY,
                BaseTestSupport::DEFAULT_PROFILE,
                BaseTestSupport::DEFAULT_VERSION
            )
        );
    }

    /**
     * @When I create board with non exist profile
     */
    public function iCreateForBoardWithNonExistProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Specification::DEFAULT_KEY,
                    'unknown',
                    BaseTestSupport::DEFAULT_VERSION
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I create board with non exist version for default profile
     */
    public function iCreateBoardWithNonExistVersionForDefaultProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Specification::DEFAULT_KEY,
                    BaseTestSupport::DEFAULT_PROFILE,
                    '0.0'
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I create board with invalid key for default profile
     */
    public function iCreateBoardWithInvalidKeyForDefaultProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    ['invalid'],
                    BaseTestSupport::DEFAULT_PROFILE,
                    BaseTestSupport::DEFAULT_VERSION
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then create command should be rejected
     */
    public function createCommandShouldBeRejected()
    {
        Assertion::isInstanceOf($this->exception, RuntimeException::class);
    }
}
