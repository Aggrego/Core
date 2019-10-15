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
use Behat\Behat\Context\Context;
use Tests\Profile\Building\TestBuildingProfile;

class CreateBoardFeatureContext implements Context
{
    public const DEFAULT_UUID = '95197308-949c-4a58-927b-081178aa0d3a';
    public const DEFAULT_KEY = ['key' => 'test'];

    private $useCase;

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
}
