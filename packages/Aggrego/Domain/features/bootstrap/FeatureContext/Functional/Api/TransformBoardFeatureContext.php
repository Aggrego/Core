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

use Aggrego\Domain\Api\Command\TransformBoard\Command;
use Aggrego\Domain\Api\Command\TransformBoard\UseCase;
use Aggrego\Domain\Shared\Exception\InvalidArgumentException;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Exception;
use RuntimeException;
use Tests\Profile\BoardConstruction\Builder;

class TransformBoardFeatureContext implements Context
{
    /**
     * @var UseCase
     */
    private $useCase;

    /**
     * @var RuntimeException
     */
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
        } catch (Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then transform command should be rejected
     */
    public function transformCommandShouldBeRejected()
    {
        Assertion::isInstanceOf($this->exception, InvalidArgumentException::class);
    }
}
