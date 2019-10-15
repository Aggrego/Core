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

namespace FeatureContext\Functional\Api;

use Aggrego\Application\Api\Command\CreateBoard\Command;
use Aggrego\Application\Api\Command\CreateBoard\UseCase;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Profile\Building\TestBuildingProfile;
use Throwable;

class CreateBoardFeatureContext implements Context
{
    private const DEFAULT_UUID = '95197308-949c-4a58-927b-081178aa0d3a';
    private const DEFAULT_KEY = ['key' => 'test'];

    private $useCase;

    /**
     * @var Throwable
     */
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
                self::DEFAULT_UUID,
                self::DEFAULT_KEY,
                TestBuildingProfile::NAME,
                TestBuildingProfile::VERSION
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
                    Builder::DEFAULT_UUID,
                    Builder::DEFAULT_KEY,
                    'unknown',
                    BaseTestWatchman::DEFAULT_VERSION
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
                    Builder::DEFAULT_UUID,
                    Builder::DEFAULT_KEY,
                    BaseTestWatchman::DEFAULT_PROFILE,
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
                    Builder::DEFAULT_UUID,
                    ['invalid'],
                    BaseTestWatchman::DEFAULT_PROFILE,
                    BaseTestWatchman::DEFAULT_VERSION
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
